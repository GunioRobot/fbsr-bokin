from django.conf.urls.defaults import *
from fbsr.bokin.models import Event
from fbsr.bokin.models import UserProfile

info_dict = {
    'queryset': Event.objects.order_by('OpenDate').all().reverse()[:100],
}

info_dict2 = {
    'queryset': UserProfile.objects.all(),
}


urlpatterns = patterns('',
    (r'^$', 'fbsr.bokin.views.index'),
    (r'^atburdur/skraning/$', 'fbsr.bokin.views.register_on_event'),
    (r'^atburdur/afskraning/$', 'fbsr.bokin.views.register_off_event'),
    (r'^notandi/skra/$', 'fbsr.bokin.views.register_nilli'),
    (r'^notendur/$', 'django.views.generic.list_detail.object_list', info_dict2),
    (r'^atburdir/$', 'django.views.generic.list_detail.object_list', info_dict),
    (r'^atburdur/(?P<event_id>\d+)/view/$', 'fbsr.bokin.views.view_event'),
    #(r'^atburdir/$', 'django.views.generic.list_detail.object_list',  dict(info_dict, template_name='bokin/event_list.html')),
    #(r'^(?P<object_id>\d+)/$', 'django.views.generic.list_detail.object_detail', info_dict),
    #url(r'^(?P<object_id>\d+)/results/$', 'django.views.generic.list_detail.object_detail', dict(info_dict, template_name='vidburdir/results.html'), 'poll_results'),
    #(r'^(?P<poll_id>\d+)/vote/$', 'bokin.vidburdir.views.vote'),
)
