from subprocess import Popen
from time import sleep

if __name__ == '__main__':
    p = []
    p.append(Popen('python acmicpc.py'))
    p.append(Popen('python contest.py'))
    p.append(Popen('python info.py'))
    p.append(Popen('python status.py'))
    sleep(10)
    for subprocess in p:
        subprocess.terminate()
