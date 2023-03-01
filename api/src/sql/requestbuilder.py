from typing import List


class RequestBuilder():
    def __init__(self, cursor, keys: List[str], table: str) -> None:
        self.cursor = cursor
        self.keys = keys
        self.table = table
        self.conditions = []

    def execute(self, values=None):
        if values is None:
            values = ()
        self.cursor.execute(self._generate_query(), values)
        return self._process_result()
    
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
    
    def _process_result(self):
        tab = []
        for values in self.cursor:
            obj = {}
            for i, val in enumerate(values):
                obj[self.keys[i]] = val
            tab.append(obj)
        return tab
