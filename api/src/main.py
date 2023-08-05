from typing import List, Union, Dict, Any

from fastapi import FastAPI, Depends, HTTPException
from fastapi.middleware.cors import CORSMiddleware

from auth.auth_bearer import JWTBearer
from auth.users import register_user, check_user, get_token, get_user_id, get_user_login_info, encrypt
from db.users import get_user_info, delete_user, update_user, get_users

app = FastAPI()

app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)


# AUTH

@app.get("/auth", tags=["auth"])
async def endpoint_user_login_info(token: str = Depends(JWTBearer())) -> Dict[str, Any]:
    return get_user_login_info(token)


@app.post("/auth", tags=["auth"])
async def endpoint_user_login(user_mail: str, user_password: str) -> str:
    if check_user(user_mail, user_password):
        return get_token(user_mail)
    raise HTTPException(400, "Can't authentificate user")


# USER

@app.get("/users", tags=["user"])
async def endpoint_all_users_info() -> List[Dict[str, Any]]:
    return get_users()


@app.get("/user", tags=["user"])
async def endpoint_user_login_info(token: str = Depends(JWTBearer()), user_login: str = None) -> Dict[str, Any]:
    if user_login is None:
        return get_user_info(get_user_id(token))
    else:
        return get_user_info(user_login)


@app.post("/user", tags=["user"])
async def endpoint_create_user(login: str, password: str, nickname: str, user_class: str):
    return register_user(login, password, nickname, user_class)


@app.put("/user", tags=["user"])
async def endpoint_update_user(user_mail: str = None, user_password: str = None, user_name: str = None,
                               user_sex: str = None, user_country: str = None,
                               user_city: str = None, token: str = Depends(JWTBearer())):
    if user_password is not None:
        user_password = encrypt(user_password)
    return update_user(get_user_id(token), user_mail, user_password, user_name, user_sex, user_country, user_city)


@app.delete("/user", tags=["user"])
async def endpoint_delete_user(token: str = Depends(JWTBearer())):
    return delete_user(get_user_id(token))
