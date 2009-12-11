# -*- coding: UTF-8 -*-
import datetime
from django.shortcuts import render_to_response, get_object_or_404
from django.http import HttpResponseRedirect
from django.core.urlresolvers import reverse
from django.db.models import Q
from django.contrib.auth.models import User, Group
from fbsr.bokin.models import Event, UserProfile, EventRegistration, Division
from fbsr.bokin.forms import EventForm, UserForm, UserProfileForm


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
    cursor.execute("SELECT id, imageurl, event_name, event_type, date_format(registereddate,'%%Y-%%m-%%d %%H:%%i') as registereddate, fullname , replace(user_group,'Inngenginn','') as user_group, PhoneNumer FROM event_registrations WHERE unregistereddate is null order by event_name, user_group, registereddate") 
    dic = getDictsFromCursor(cursor)
    #cursor.close()
    return dic

def registrations(event_id):
    from django.db import connection
    cursor = connection.cursor()
    cursor.execute("SELECT id, imageurl, event_name, event_type, date_format(registereddate,'%%Y-%%m-%%d %%H:%%i') as registereddate, fullname , replace(user_group,'Inngenginn','') as user_group, PhoneNumer FROM event_registrations WHERE event_id="+event_id+" order by event_name, user_group, registereddate") 
    dic = getDictsFromCursor(cursor)
    #cursor.close()
    return dic

# innra fall kallar í db til að sækja user_id á nýliða
def get_userid():
    from django.db import connection
    cursor = connection.cursor()
    cursor.execute("select get_userid() from dual")
    nextRow = cursor.fetchone()[0]
    cursor.close()
    return nextRow


def index(request):
    open_events = Event.objects.filter(Q(CloseDate__gte=datetime.datetime.now()) | Q(CloseDate__isnull=True))
    curr_reg = current_registrations()
    eventform = EventForm()
    
    return render_to_response('bokin/index.html', {'open_events': open_events, 'current_registrations': curr_reg, 'eventform': eventform})

def close_event(request):
    #ef upp kemur villa hafa gögn á forsíðu til
    open_events = Event.objects.filter(Q(CloseDate__gte=datetime.datetime.now()) | Q(CloseDate__isnull=True))
    curr_reg = current_registrations()
    eventform = EventForm()
    
def register_on_event(request):
    #ef upp kemur villa hafa gögn á forsíðu til
    open_events = Event.objects.filter(Q(CloseDate__gte=datetime.datetime.now()) | Q(CloseDate__isnull=True))
    curr_reg = current_registrations()
    eventform = EventForm(request.POST)    
    if eventform.is_valid():
      pass
    else:
      return render_to_response('bokin/index.html', {'object': UserProfile,'error_message': "Notandi fannst ekki.",'open_events': open_events, 'current_registrations': curr_reg, 'eventform': eventform})
    
    try:
      up=UserProfile.objects.get(SSN=request.POST['SSN'])
    except (KeyError, UserProfile.DoesNotExist, UserProfile.MultipleObjectsReturned):
        return render_to_response('bokin/index.html', {'object': UserProfile,'error_message': "Notandi fannst ekki.",'open_events': open_events, 'current_registrations': curr_reg, 'eventform': eventform})
    
    try:
        selected_user = User.objects.get(pk=up.User_id)
    except (KeyError, User.DoesNotExist):
        return render_to_response('bokin/index.html', {'object': User,'error_message': "Notandi fannst ekki.",'open_events': open_events, 'current_registrations': curr_reg, 'eventform': eventform})
    
    if request.POST['event_id']=='new':
      event=eventform.save(commit=False)
      event.User_id=selected_user.id
      event.save()
    else:
      try:
	event = Event.objects.get(pk=request.POST['event_id'])
      except (KeyError, Event.DoesNotExist):
	return render_to_response('bokin/index.html', {'object':Event, 'error_message':"Valinn atburður ekki til.", 'open_events':open_events, 'current_registrations': curr_reg, 'eventform': eventform})
    
   
    curr_er = EventRegistration.objects.filter(User=selected_user.id, UnregisteredDate=None ) 
    if curr_er.count() != 0:
      return render_to_response('bokin/index.html', {'object': UserProfile,'error_message': "Notandi þegar skráður á atburð.",'open_events': open_events, 'current_registrations': curr_reg, 'eventform': eventform}) 
        
    er=EventRegistration(User=selected_user, Event=event, RegisteredDate=datetime.datetime.now(), UnregisteredDate=None)
    er.save()
    return HttpResponseRedirect(reverse('fbsr.bokin.views.index', args=()))
    
def register_off_event(request):
    #ef upp kemur villa hafa gögn á forsíðu til
    open_events = Event.objects.filter(Q(CloseDate__gte=datetime.datetime.now()) | Q(CloseDate__isnull=True))
    curr_reg = current_registrations()
    eventform = EventForm()    
    
    try:
      er = EventRegistration.objects.get(pk=request.POST['id'])
    except (KeyError, EventRegistration.DoesNotExist):
      return render_to_response('bokin/index.html', {'object': event,'error_message': "Valinn atburður ekki til.",'open_events': open_events, 'current_registrations': curr_reg, 'eventform': eventform})
    er.UnregisteredDate=datetime.datetime.now()
    er.save()
    return HttpResponseRedirect(reverse('fbsr.bokin.views.index', args=()))
    
def register_nilli(request):
    if request.method == 'POST':
        userform= UserForm(request.POST)
	userprofileform= UserProfileForm(request.POST)

        if userform.is_valid(): 
	     if userprofileform.is_valid(): 
		user=userform.save(commit=False)
		user.is_staff=0
		user.is_active=0
		user.is_superuser=0
		user.id=get_userid()
		group=Group.objects.get(name='Nýliði')
		user.save()
		user.groups.add(group)
		userprofile=userprofileform.save(commit=False)
		userprofile.User_id=user.id
		userprofile.save()
		return HttpResponseRedirect(reverse('fbsr.bokin.views.index', args=()))
	     else:
		  return render_to_response('bokin/stofna_nilla.html', {'userform': userform,'userprofileform':userprofileform,'error_message': userprofileform.errors})
            
	else:
	  return render_to_response('bokin/stofna_nilla.html', {'userform': userform,'userprofileform':userprofileform,'error_message': userform.errors})
	 
    userform= UserForm()
    userprofileform= UserProfileForm()
    return render_to_response('bokin/stofna_nilla.html', {'userform': userform,'userprofileform':userprofileform})

def view_event(request, event_id):
    e = get_object_or_404(Event, pk=event_id)
    #er = EventRegistration.objects.filter(Event=event_id) 
    er = registrations(event_id)
    return render_to_response('bokin/view_event.html', {'event': e, 'eventreg': er})