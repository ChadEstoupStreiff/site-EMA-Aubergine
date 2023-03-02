from fastapi import FastAPI
from sql import RequestBuilder


app = FastAPI()


@app.get("/users", tags=["Users"])
async def get_users(page: int = 0, pageSize: int = 10, regex: str = None):
    request = RequestBuilder(["login", "nickname", "type"], "User")
    return request.execute()


@app.get("/user/{login}", tags=["Users"])
async def get_user(login: str):
    request = RequestBuilder(["login", "nickname", "type"], "User")
    request.add_condition("login", "%s")
    return request.execute_single(values=(login,))

@app.get("/user/{login}/blocs", tags=["Users", "Blocs"])
async def get_blocs_user(login: str):
    request = RequestBuilder(["name", "difficulty", "creator", "date"], "Bloc")
    request.add_condition("creator", "%s")
    return request.execute(values=(login,))


@app.get("/blocs", tags=["Blocs"])
async def get_blocs(page: int = 0, pageSize: int = 10, regex: str = None):
    request = RequestBuilder(["name", "difficulty", "creator", "date"], "Bloc")
    return request.execute()


@app.get("/bloc/{name}", tags=["Blocs"])
async def get_bloc(name: str):
    # TODO add desc
    request = RequestBuilder(["name", "difficulty", "creator", "date", "types", "description", "images", "video"], "Bloc")
    request.add_condition("name", "%s")
    return request.execute_single(values=(name,))
