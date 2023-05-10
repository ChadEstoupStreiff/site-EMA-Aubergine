from fastapi import FastAPI
from sql import RequestBuilder
from fastapi.middleware.cors import CORSMiddleware


app = FastAPI()

app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)



@app.get("/users", tags=["Users"])
async def get_users(page: int = 0, page_size: int = 10, regex: str = None):
    request = RequestBuilder(["login", "nickname", "type"], "User")
    request.set_page(page, page_size=page_size)
    request.set_regex(regex)
    return request.execute()


@app.get("/user/{login}", tags=["Users"])
async def get_user(login: str):
    request = RequestBuilder(["login", "nickname", "type", "email", "phone", "class", "description", "nivbloc", "nivdif", "show"], "User")
    request.add_condition("login", "%s")
    user = request.execute_single(values=(login,))
    if user["show"] == 0:
        user["email"] = "XXX"
        user["phone"] = "XXX"
    return user

@app.get("/user/{login}/blocs", tags=["Users", "Blocs"])
async def get_blocs_user(login: str, page: int = 0, page_size: int = 10, regex: str = None):
    request = RequestBuilder(["name", "difficulty", "creator", "date"], "Bloc")
    request.set_page(page, page_size=page_size)
    request.set_regex(regex)
    request.add_condition("creator", "%s")
    return request.execute(values=(login,))


@app.get("/blocs", tags=["Blocs"])
async def get_blocs(page: int = 0, page_size: int = 10, regex: str = None):
    request = RequestBuilder(["name", "difficulty", "creator", "date"], "Bloc")
    request.set_page(page, page_size=page_size)
    request.set_regex(regex)
    return request.execute()


@app.get("/bloc/{name}", tags=["Blocs"])
async def get_bloc(name: str):
    request = RequestBuilder(["name", "difficulty", "creator", "date", "types", "zones", "description", "images", "holds"], "Bloc")
    request.add_condition("name", "%s")
    return request.execute_single(values=(name,))
