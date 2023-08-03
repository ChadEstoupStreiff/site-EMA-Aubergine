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


def update_user(old_login: str, user_mail: str = None, user_password: bytes = None, user_name: str = None,
                user_sex: str = None,
                user_country: str = None,
                user_city: str = None) -> bool:
    # TODO
    return True


def create_user(login: str, password: bytes, nickname: str, user_class: str) -> bool:
    data = DB().commit("""INSERT INTO Users
(login, password, nickname, class, type, show)
VALUES (%s,%s,%s,%s,%s,%s)""",
                       (login, password, nickname, user_class, "GUEST", 1))
    if data is not None:
        return data
    raise HTTPException(400, "Invalid variables")


def get_user_password(email: str) -> bytes:
    data = DB().execute_single("""SELECT password FROM Users WHERE user_mail=%s""", (email,))
    if data is not None:
        return data[0]
    raise HTTPException(400, "Invalid credentials")


def get_users() -> List:
    data = DB().execute("""SELECT user_mail, user_name, user_sex, user_country, user_city FROM Users""",
                        keys=("mail", "name", "sex", "country", "city"))
    if data is not None:
        return data
    raise HTTPException(500, "DB Error")


def get_user_info(user_mail: str) -> Dict[str, str]:
    data = DB().execute_single(
        """SELECT user_mail, user_name, user_sex, user_country, user_city FROM Users WHERE user_mail=%s""",
        (user_mail,), ("mail", "name", "sex", "country", "city"))
    if data is not None:
        return data
    raise HTTPException(400, "Invalid credentials")
