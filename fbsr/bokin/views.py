# -*- coding: latin-1 -*-
import datetime
from django.shortcuts import render_to_response, get_object_or_404
from django.http import HttpResponseRedirect
from django.core.urlresolvers import reverse
from django.contrib.auth.models import User
from fbsr.bokin.models import Event, UserProfile, EventRegistration

def getDictsFromCursor(cursor):
    while True:
         nextRow = cursor.fetchone()
         if not nextRow: break
         d = {}
         for (i, columnDesc) in enumerate(cursor.description):
             d[columnDesc[0]] = nextRow[i]
         yield d

def current_registrations():
    from django.db import connection
    cursor = connection.cursor()
    cursor.execute("SELECT imageurl, event_name, event_type, registereddate, fullname , user_group, PhoneNumer FROM event_registrations WHERE unregistereddate is null order by event_name, user_group, registereddate") 
    return getDictsFromCursor(cursor)

def registered_on_event(event_id):
    from django.db import connection
    cursor = connection.cursor()
    cursor.execute("SELECT imageurl, event_name, event_type, registereddate, fullname , user_group, PhoneNumer FROM event_registrations WHERE unregistereddate is null and event_id="+event_id+" order by event_name, user_group, registereddate" ) 
    return getDictsFromCursor(cursor)

def open_events():
    from django.db import connection
    cursor = connection.cursor()
    cursor.execute("SELECT id, division, event, cnt FROM events WHERE CloseDate is null") 
    return getDictsFromCursor(cursor)

def index(request):
    open_events_old = Event.objects.filter(CloseDate__isnull=True)
    oe = open_events()
    e = dict()
    for event in oe:
      e[str(event['id'])]=registered_on_event(str(event['id']))
    curr_reg = current_registrations()
    return render_to_response('bokin/index.html', {'open_events_old': open_events_old, 'current_registrations': curr_reg, 'in_event':e})


def register_on_event(request):
    try:
      event = Event.objects.get(pk=request.POST['event_id'])
    except (KeyError, Event.DoesNotExist):
      return render_to_response('bokin/index.html', {'object': event,'error_message': "Valinn atburður ekki til.",})
    try:
        selected_user = User.objects.get(pk=UserProfile.objects.get(SSN=request.POST['SSN']).User_id)
    except (KeyError, UserProfile.DoesNotExist):
        return render_to_response('bokin/index.html', {'object': p,'error_message': "Notandi ekki til.",})
   
    er=EventRegistration(User=selected_user, Event=event, RegisteredDate=datetime.datetime.now(), UnregisteredDate=None)
    er.save()
    return HttpResponseRedirect(reverse('fbsr.bokin.views.index', args=()))