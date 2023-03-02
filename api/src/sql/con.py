import mariadb
import sys


def get_cursor(config):
    try:
        conn = mariadb.connect(
            user="root",
            password=config["SQL_ROOTPASSWORD"],
            host="ema_aubergine_database",
            port=3306,
            database=config["SQL_DATABASE"]
        )
    except mariadb.Error as e:
        print(f"Error connecting to MariaDB Platform: {e}")
        sys.exit(1)
    return conn.cursor(prepared=True)
