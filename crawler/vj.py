import json, urllib, urllib2, cookielib

login = 'https://vjudge.net/user/login'
submissions = 'https://cn.vjudge.net/user/submissions?username=Infinity25&status=AC&pageSize=100'

cookie = cookielib.LWPCookieJar()
opener = urllib2.build_opener(urllib2.HTTPCookieProcessor(cookie))
opener.addheaders = [('user-agent', 'Infinity')]
response = opener.open(login, urllib.urlencode({
    'username': 'Infinity25',
    'password': '9602252335',
}))
assert response.read() == 'success'
print 'Login succeeded'
html = opener.open(submissions).read()
j = json.loads(html)
# id(vj) id(oj) oj index result time memory language code-len time
for s in j['data']:
    print {
        'uuid': s[1],
        'oj': s[2],
        'id': s[3],
        'verdict': s[4],
        'time': s[5],
        'memory': s[6],
        'language': s[7],
        'length': s[8],
        'submitted_at': s[9]
    }
