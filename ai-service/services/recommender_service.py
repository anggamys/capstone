import pandas as pd
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity

from database import engine


def normalize_text(value):
    if value is None:
        return ""

    if isinstance(value, list):
        return " ".join([str(item) for item in value if item])

    return str(value)


def build_user_profile_text(preferences: dict) -> str:
    parts = []

    parts.extend(preferences.get("categories", []))
    parts.extend(preferences.get("activities", []))
    parts.extend(preferences.get("visit_times", []))

    parts.append(preferences.get("travel_type", ""))
    parts.append(preferences.get("transportation", ""))
    parts.append(preferences.get("access_level", ""))
    parts.append(preferences.get("crowd_level", ""))

    return " ".join([str(item).lower() for item in parts if item])


def fetch_destinations_from_db() -> pd.DataFrame:
    query = """
        SELECT
            d.id,
            d.name AS destination_name,
            d.slug,
            d.description,
            d.district,
            d.ticket_price,
            d.access_level,
            d.operational_hours,
            dc.name AS category_name,
            dsc.name AS subcategory_name,

            GROUP_CONCAT(DISTINCT a.name SEPARATOR ' ') AS activities,
            GROUP_CONCAT(DISTINCT f.name SEPARATOR ' ') AS facilities,
            GROUP_CONCAT(DISTINCT tt.name SEPARATOR ' ') AS travel_types,
            GROUP_CONCAT(DISTINCT vt.name SEPARATOR ' ') AS visit_times,
            GROUP_CONCAT(DISTINCT tr.name SEPARATOR ' ') AS transportations

        FROM destinations d

        LEFT JOIN destination_categories dc
            ON dc.id = d.destination_category_id

        LEFT JOIN destination_subcategories dsc
            ON dsc.id = d.destination_subcategory_id

        LEFT JOIN activity_destination da
            ON da.destination_id = d.id
        LEFT JOIN activities a
            ON a.id = da.activity_id

        LEFT JOIN destination_facility df
            ON df.destination_id = d.id
        LEFT JOIN facilities f
            ON f.id = df.facility_id

        LEFT JOIN destination_travel_type dtt
            ON dtt.destination_id = d.id
        LEFT JOIN travel_types tt
            ON tt.id = dtt.travel_type_id

        LEFT JOIN destination_visit_time dvt
            ON dvt.destination_id = d.id
        LEFT JOIN visit_times vt
            ON vt.id = dvt.visit_time_id

        LEFT JOIN destination_transportation dtr
            ON dtr.destination_id = d.id
        LEFT JOIN transportations tr
            ON tr.id = dtr.transportation_id

        WHERE d.status = 'active'

        GROUP BY
            d.id,
            d.name,
            d.slug,
            d.description,
            d.district,
            d.ticket_price,
            d.access_level,
            d.operational_hours,
            dc.name,
            dsc.name
    """

    return pd.read_sql(query, engine)


def build_destination_profile(row) -> str:
    parts = [
        row.get("destination_name", ""),
        row.get("description", ""),
        row.get("district", ""),
        row.get("category_name", ""),
        row.get("subcategory_name", ""),
        row.get("activities", ""),
        row.get("facilities", ""),
        row.get("travel_types", ""),
        row.get("visit_times", ""),
        row.get("transportations", ""),
        row.get("access_level", ""),
    ]

    return " ".join([normalize_text(item).lower() for item in parts if item])


def get_label(score_percent: int) -> str:
    if score_percent >= 85:
        return "Sangat Direkomendasikan"
    if score_percent >= 70:
        return "Direkomendasikan"
    return "Alternatif Rekomendasi"

def get_category_color(category_name: str) -> str:
    category_colors = {
        "Pantai": "#00CC96",
        "Air Terjun": "#36B37E",
        "Pendakian & Gunung": "#FF9900",
        "Cagar Budaya": "#FFB82E",
        "Religi": "#5243AA",
        "Kawasan Wisata Alam": "#00B8D9",
        "Perkebunan & Pemandangan": "#2196F3",
        "Ekowisata & Konservasi": "#00C853",
        "Taman Nasional & Hutan Lindung": "#2E7D32",
        "Budaya & Tradisi": "#9C27B0",
        "Bahari & Kepulauan": "#1976D2",
        "Olahraga Air": "#00BCD4",
        "Wellness & Kesehatan": "#F48FB1",
        "Kuliner & Gastronomi": "#FF5722",
        "Edukasi & Ilmu Pengetahuan": "#03A9F4",
        "Taman Rekreasi & Hiburan": "#FF6F00",
        "Petualangan & Ekstrem": "#FF3D00",
        "Perkemahan & Glamping": "#7CB342",
        "Alam Terbuka & Santai": "#64B5F6",
        "Situs Sejarah & Warisan Dunia": "#795548",
    }

    normalized_name = normalize_text(category_name).lower()
    
    for cat, color in category_colors.items():
        if normalize_text(cat).lower() == normalized_name:
            return color
            
    return "#9E9E9E"


def build_reasons(row, preferences: dict) -> list:
    reasons = []

    selected_categories = [item.lower() for item in preferences.get("categories", [])]
    selected_activities = [item.lower() for item in preferences.get("activities", [])]
    selected_visit_times = [item.lower() for item in preferences.get("visit_times", [])]

    category_name = normalize_text(row.get("category_name")).lower()
    activities = normalize_text(row.get("activities")).lower()
    visit_times = normalize_text(row.get("visit_times")).lower()
    access_level = normalize_text(row.get("access_level")).lower()

    if category_name and category_name in selected_categories:
        reasons.append("Sesuai dengan kategori wisata yang dipilih")

    if any(activity in activities for activity in selected_activities):
        reasons.append("Cocok dengan aktivitas yang diminati")

    if any(visit_time in visit_times for visit_time in selected_visit_times):
        reasons.append("Waktu kunjungan sesuai preferensi pengguna")

    if preferences.get("access_level") and preferences["access_level"].lower() == access_level:
        reasons.append("Akses lokasi sesuai preferensi pengguna")

    if not reasons:
        reasons.append("Memiliki kemiripan dengan preferensi wisata Anda")

    return reasons


def get_recommendations(preferences: dict, top_n: int = 8):
    destinations = fetch_destinations_from_db()

    if destinations.empty:
        return []

    user_text = build_user_profile_text(preferences)

    if not user_text.strip():
        return []

    destinations["profile_text"] = destinations.apply(build_destination_profile, axis=1)

    corpus = destinations["profile_text"].tolist()
    corpus.append(user_text)

    vectorizer = TfidfVectorizer()
    tfidf_matrix = vectorizer.fit_transform(corpus)

    destination_matrix = tfidf_matrix[:-1]
    user_vector = tfidf_matrix[-1]

    similarity_scores = cosine_similarity(user_vector, destination_matrix).flatten()

    destinations["score"] = similarity_scores

    top_destinations = destinations.sort_values(
        by="score",
        ascending=False
    ).head(top_n)

    raw_scores = top_destinations["score"].tolist()
    max_score = max(raw_scores) if raw_scores else 0
    min_score = min(raw_scores) if raw_scores else 0

    recommendations = []

    for rank, (_, row) in enumerate(top_destinations.iterrows(), start=1):
        score = float(row["score"])

        if max_score == min_score:
            score_percent = 75
        else:
            normalized_score = (score - min_score) / (max_score - min_score)
            score_percent = round(65 + (normalized_score * 30))

        recommendations.append({
            "rank": rank,
            "destination_id": str(row["id"]),
            "destination_name": row["destination_name"],
            "score": round(score, 4),
            "score_percent": score_percent,
            "label": get_label(score_percent),
            "reasons": build_reasons(row, preferences),
        })
    return recommendations