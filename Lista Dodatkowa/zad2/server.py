import pyotp
import sys

def setup(key_id):
    with open("key_id_list.txt", "r+") as f:
        lines = f.readlines()
        for line in lines:
            line = line.rstrip('\n')
            if line == key_id:
                print("Error! Given id already exists!")
                return
        f.write(key_id + '\n')
    with open("key_list.txt", "a+") as f:
        key = pyotp.random_base32(16)
        f.write(key_id + ":" + key + '\n')
    

def validate(key_id, x):
    contin = False
    with open("key_id_list.txt", "r+") as f:
        lines = f.readlines()
        for line in lines:
            line = line.rstrip('\n')
            if line == key_id:
                contin = True
    if not contin:
        print("There is no id like provided!")
        return

    key = ""

    with open("key_list.txt", "r+") as f:
        lines = f.readlines()
        for line in lines:
            line = line.rstrip('\n')
            arr = line.split(':')
            if (key_id == arr[0]):
                key = arr[1]
                break

    totp = pyotp.TOTP(key)

    if (totp.now() == x):
        print("[SUCCESS] Access given!")
    else:
        print("Access denied!")

if len(sys.argv)<3:
    print("Usage: python3 server.py (setup|validate) 'key_id' [auth_code]")
elif sys.argv[1] == 'setup':
    setup(sys.argv[2])
elif sys.argv[1] == 'validate':
    if len(sys.argv) < 4:
        print("auth_code not provided!")
        exit()
    validate(sys.argv[2], sys.argv[3])
else:
    print("Usage: python3 server.py (setup|validate) 'key_id' [auth_code]")