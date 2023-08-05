from typing import List, Dict, Union

from fastapi import HTTPException

from db.drivers import DB


def delete_user(login: str) -> bool:
    data = DB().commit("""DELETE FROM Users
WHERE login=%s""",
                       (login,))
    if data is not None:
        return data
    raise HTTPException(400, "Can't delete user")


def update_user() -> bool:
    # TODO
    return True


def create_user(login: str, password: bytes, nickname: str, user_class: str) -> bool:
    data = DB().commit("""INSERT INTO Users
(login, password, nickname, class, type, show)
VALUES (%s,%s,%s,%s,%s,%s)""",
                       (login, password, nickname, user_class, "GUEST", "1"))
    if data is not None:
        return data
    raise HTTPException(400, "Invalid variables")


def get_user_password(login: str) -> bytes:
    data = DB().execute_single("""SELECT password FROM Users WHERE login=%s""", (login,))
    if data is not None:
        return data[0]
    raise HTTPException(400, "Invalid credentials")


def get_users() -> List:
    data = DB().execute("""SELECT login, nickname, class, type, description FROM Users""",
                        keys=("login", "nickname", "class", "type", "description"))
    if data is not None:
        return data
    raise HTTPException(500, "DB Error")


def get_user_info(login: str) -> Dict[str, str]:
    data = DB().execute_single(
        """SELECT login, nickname, class, type, email, phone, description, nivbloc, nivdif, show FROM Users WHERE login=%s""",
        (login,), ("login", "nickname", "class", "type", "email", "phone", "description", "nivbloc", "nivdif", "show"))
    if data is not None:
        return data
    raise HTTPException(400, "Invalid credentials")
