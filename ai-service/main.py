from fastapi import FastAPI
from pydantic import BaseModel
from typing import List, Optional

from services.recommender_service import get_recommendations

app = FastAPI(
    title="Laras Banyuwangi AI Planner API",
    description="API rekomendasi destinasi wisata Banyuwangi",
    version="1.0.0"
)


class PlannerRequest(BaseModel):
    user_id: Optional[int] = None
    guest_token: Optional[str] = None
    categories: List[str] = []
    activities: List[str] = []
    travel_type: str = ""
    transportation: str = ""
    visit_times: List[str] = []
    budget: int = 0
    access_level: str = ""
    crowd_level: str = ""


@app.get("/")
def root():
    return {
        "message": "Laras Banyuwangi AI Planner API is running"
    }


@app.get("/health")
def health():
    return {
        "status": "ok"
    }


@app.post("/recommend")
def recommend(request: PlannerRequest):
    preferences = request.model_dump()

    recommendations = get_recommendations(preferences, top_n=8)

    return {
        "success": True,
        "recommendations": recommendations
    }