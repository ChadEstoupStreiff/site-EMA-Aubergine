import logging
from typing import Union, List, Any, Tuple

import mysql.connector
import time
from dotenv import dotenv_values


class DB:
    __instance = None

    @staticmethod
    def __new__(cls, *args, **kwargs):
        if DB.__instance is None:
            DB.__instance = super(DB, cls).__new__(
                cls, *args, **kwargs
            )

            config = dotenv_values("/.env")
            DB.__instance.conn = None
            for _ in range(10):
                try:
                    conn = mysql.connector.connect(host="aubergines_database", user="root",
                                                   passwd=config["SQL_ROOTPASSWORD"],
                                                   database=config["SQL_DATABASE"])
                    DB.__instance.conn = conn
                    break
                except:
                    time.sleep(1)

            if DB.__instance.conn is None:
                logging.critical("Can't connect to DB")
                exit(1)
        return DB.__instance

    def _get_cursor(self):
        return self.conn.cursor(prepared=True)

    def commit(self, query: str, values: Tuple = None) -> bool:
        if values is None:
            values = ()
        cursor = self._get_cursor()
        cursor.execute(query, values)
        affected = cursor.rowcount
        if cursor is not None:
            cursor.close()
        self.conn.commit()
        return affected > 0

    def execute(self, query: str, values: Tuple = None, keys: Tuple = None) -> Union[List[List[Any]], None]:
        if values is None:
            values = ()
        cursor = self._get_cursor()
        cursor.execute(query, values)

        data = [[val for val in values] for values in cursor]
        if keys is not None and len(data) > 0:
            data_dict = []
            for data_row in data:
                data_dict_row = {}
                for i, key in enumerate(keys):
                    data_dict_row[key] = data_row[i]
                data_dict.append(data_dict_row)
            data = data_dict
        if cursor is not None:
            cursor.close()
        return data

    def execute_single(self, query: str, values: Tuple = None, keys: Tuple = None) -> Union[List[Any], None]:
        data = self.execute(query, values, keys)
        if len(data) > 0:
            return data[0]
        return None
