import json
from selenium import webdriver
import sys

with open('data.json') as f:
    data = json.load(f)
    for index, ent in enumerate(data):
        if not ent["_source"]["layers"]:
            continue
        print index,":", ent["_source"]["layers"]["http.host"][0].encode("ascii","replace")

    index = input('Choose ID:')
    host = data[index]["_source"]["layers"]["http.host"][0].encode("ascii","replace")
    fullCookie = data[index]["_source"]["layers"]["http.cookie"][0].encode("ascii","replace")
    cookies = fullCookie.split("; ")

    driver = webdriver.Firefox()
    driver.get("http://"+host+"/")
    for cookie in cookies:
        splited = cookie.split("=")
        driver.add_cookie({'name':splited[0], 'value':splited[1], 'path':'/'})
    print("Refresh you Browser!")
