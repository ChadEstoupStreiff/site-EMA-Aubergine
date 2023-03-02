from typing import List

from dotenv import dotenv_values
from sql import get_cursor

config = dotenv_values(".env")


class RequestBuilder():
    def __init__(self, keys: List[str], table: str) -> None:
        self.keys = keys
        self.table = table
        self.conditions = []
        self.page = None
        self.page_size = 10
        self.regex = None

    def set_page(self, page: int, page_size:int=None):
        self.page = page
        if page_size is not None:
            self.page_size = page_size

    def set_regex(self, regex:str):
        self.regex = regex

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
            query += f"{key}, "
        query = f"{query[:-2]} FROM {self.table}" 
        if len(self.conditions) > 0 or self.regex is not None:
            query += " WHERE "
            if len(self.conditions) > 0:
                query += "("
                for cond in self.conditions:
                    query += f"{cond[0]} = {cond[1]} AND "
                query = f"{query[:-4]})"
            if self.regex is not None:
                if len(self.conditions) > 0:
                    query += "AND ("
                else:
                    query += "("

                for key in self.keys:
                    query += f"{key} LIKE '%{self.regex}%' OR "
                query = f"{query[:-4]})"
        if self.page is not None:
            query += f" LIMIT {self.page_size} OFFSET {self.page * self.page_size}"
        return query

    def _process_result(self, cursor):
        tab = []
        for values in cursor:
            obj = {}
            for i, val in enumerate(values):
                obj[self.keys[i]] = val
            tab.append(obj)
        return tab
