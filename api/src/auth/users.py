from typing import Dict

import bcrypt
from dotenv import dotenv_values
from fastapi import HTTPException

from auth.auth_handler import decode_jwt
from auth.auth_handler import sign_jwt
from db.users import get_user_password, create_user


def encrypt(text: str) -> bytes:
    config = dotenv_values("/.env")
    return bcrypt.hashpw(text.encode(), bcrypt.gensalt(rounds=int(config["SALT_LENGTH"])))


def get_token(login: str) -> str:
    return sign_jwt(login)


def register_user(login: str, password: str, nickname: str, user_class: str) -> str:
    password = encrypt(password)
    if create_user(login, password, nickname, user_class):
        return get_token(login)
    raise HTTPException(400, detail="Can't create user")


def check_user(login: str, password: str) -> bool:
    encrypted_password = get_user_password(login)
    return encrypted_password is not None and bcrypt.checkpw(password.encode(),
                                                             bytes(encrypted_password))


def get_user_login_info(token: str) -> Dict[str, str]:
    return decode_jwt(token)


def get_user_id(token: str) -> str:
    return get_user_login_info(token)["user_id"]
