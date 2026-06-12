import os
import joblib
import pandas as pd

BASE_DIR = os.path.dirname(os.path.abspath(__file__))
ARTIFACT_DIR = os.path.join(BASE_DIR, "artifacts")

model_path = os.path.join(ARTIFACT_DIR, "destinasi_model.pkl")

data = joblib.load(model_path)

print("Tipe data:", type(data))

if isinstance(data, pd.DataFrame):
    print("\nKolom:")
    print(data.columns.tolist())

    print("\nJumlah data:")
    print(len(data))

    print("\n10 data pertama:")
    print(data.head(10))

    if "destination_name" in data.columns:
        print("\nDaftar nama destinasi:")
        print(data["destination_name"].head(50).to_string(index=False))
    elif "name" in data.columns:
        print("\nDaftar nama destinasi:")
        print(data["name"].head(50).to_string(index=False))

    data.to_csv(os.path.join(ARTIFACT_DIR, "cek_destinasi_model.csv"), index=False)
    print("\nBerhasil export ke artifacts/cek_destinasi_model.csv")

else:
    print("\nIsi data:")
    print(data)