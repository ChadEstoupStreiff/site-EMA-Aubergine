from fastapi import FastAPI
from dotenv import dotenv_values
from sql import RequestBuilder, get_cursor


config = dotenv_values(".env")
cur = get_cursor(config)
app = FastAPI()


@app.get("/users")
async def get_users(page: int = 0, pageSize: int = 10, regex: str = None):
    request = RequestBuilder(cur, ["login", "nickname", "type"], "User")
    return request.execute()


@app.get("/user/{login}")
async def get_user(login: str):
    request = RequestBuilder(cur, ["login", "nickname", "type"], "User")
    request.add_condition("login", "%s")
    return request.execute(values=(login,))


@app.get("/blocs")
async def get_blocs(page: int = 0, pageSize: int = 10, regex: str = None):
    request = RequestBuilder(cur, ["name", "dif", "creator", "date"], "Bloc")
    return request.execute()


@app.get("/bloc/{name}")
async def get_bloc(name: str):
    # TODO add desc
    request = RequestBuilder(cur, ["name", "dif", "creator", "date", "types", "images", "video"], "Bloc")
    request.add_condition("name", "%s")
    return request.execute(values=(name,))
