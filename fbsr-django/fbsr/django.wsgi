import os
import sys
sys.path.append('/home/fbsr/fbsr-bokin')
sys.path.append('/home/fbsr/fbsr-bokin/fbsr')

os.environ['DJANGO_SETTINGS_MODULE'] = 'settings'

import django.core.handlers.wsgi
application = django.core.handlers.wsgi.WSGIHandler()


