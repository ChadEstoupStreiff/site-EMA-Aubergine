from fastapi import FastAPI
import mariadb
import sys
from dotenv import dotenv_values
import json

# Get ENV values
config = dotenv_values(".env")

# Connect to MariaDB Platform
try:
    conn = mariadb.connect(
        user="root",
        password=config["SQL_ROOTPASSWORD"],
        host="ema_aubergine_database",
        port=3306,
        database=config["SQL_DATABASE"]

    )
except mariadb.Error as e:
    print(f"Error connecting to MariaDB Platform: {e}")
    sys.exit(1)
cur = conn.cursor(prepared=True)

# Launch fastAPI
app = FastAPI()


@app.get("/users")
async def get_users(page: int = 0, pageSize: int = 10, regex: str = None):
    query = "SELECT login, nickname, type FROM User"
    values = ()

    cur.execute(query, values)
    
    tab = []
    for (login, nickname, type) in cur:
        tab.append([login, nickname, type])

    return json.dumps(tab).replace('\\"',"\"")


@app.get("/blocs")
async def get_blocs(page: int = 0, pageSize: int = 10, regex: str = None):
    query = "SELECT name, dif, creator, date FROM Bloc"
    values = ()

    cur.execute(query, values)
    
    tab = []
    for (name, dif, creator, date) in cur:
        tab.append([name, dif, creator, date.strftime("%Y-%m-%d")])

    return json.dumps(tab).replace('\\"',"\"")
