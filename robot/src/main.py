import schedule

def clean():
    print("Fooing around")

schedule.every().day.at("00:00").do(clean)