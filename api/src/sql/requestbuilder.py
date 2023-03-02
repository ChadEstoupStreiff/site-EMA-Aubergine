from typing import List

from dotenv import dotenv_values
from sql import get_cursor

config = dotenv_values(".env")


class RequestBuilder():
    def __init__(self, keys: List[str], table: str) -> None:
        self.keys = keys
        self.table = table
        self.conditions = []

    def execute(self, values=None):
        cursor = get_cursor(config)
        if values is None:
            values = ()
        cursor.execute(self._generate_query(), values)
        data = self._process_result(cursor)
        cursor.close()
        return data

    def execute_single(self, values=None):
        return self.execute(values=values)[0]

    def add_condition(self, key: str, value: str):
        self.conditions.append([key, value])

    def _generate_query(self):
        query = "SELECT "
        for key in self.keys:
            query += key + ", "
        query = query[:-2] + " FROM " + self.table
        if len(self.conditions) > 0:
            query += " WHERE "
            for cond in self.conditions:
                query += cond[0] + " = " + cond[1] + ", "
            query = query[:-2]
        return query

    def _process_result(self, cursor):
        tab = []
        for values in cursor:
            obj = {}
            for i, val in enumerate(values):
                obj[self.keys[i]] = val
            tab.append(obj)
        return tab
