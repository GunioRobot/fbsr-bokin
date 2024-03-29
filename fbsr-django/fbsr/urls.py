from django.conf.urls.defaults import *

# Uncomment the next two lines to enable the admin:
from django.contrib import admin
admin.autodiscover()

urlpatterns = patterns('',
    # Example:
    # (r'^fbsr/', include('fbsr.foo.urls')),

    # Uncomment the admin/doc line below and add 'django.contrib.admindocs' 
    # to INSTALLED_APPS to enable admin documentation:
    # (r'^admin/doc/', include('django.contrib.admindocs.urls')),

    # Uncomment the next line to enable the admin:
    (r'^bokin/', include('fbsr.bokin.urls')),
    (r'^admin/(.*)', admin.site.root),
    (r'^myadmin/jsi18n', 'django.views.i18n.javascript_catalog'),
    (r'^media/(?P<path>.*)$', 'django.views.static.serve',{'document_root': '/home/atom/prog/fbsr/fbsr_media'}),
    (r'^$', 'fbsr.bokin.views.index'),


)
