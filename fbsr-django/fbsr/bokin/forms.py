# -*- coding: latin-1 -*-
from django.forms import Form, ModelForm
from django import forms
from django.contrib.admin import widgets                                       
from django.contrib.auth.models import User
from fbsr.bokin.models import Event, UserProfile
from django.db import models


class EventForm(ModelForm):
    CloseDate=forms.SplitDateTimeField(required = False,widget=widgets.AdminSplitDateTime())
    class Meta:
        model = Event
	fields = ['Division', 'Name', 'OpenDate','CloseDate']
    def __init__(self, *args, **kwargs):
        super(EventForm, self).__init__(*args, **kwargs)
	self.fields['Division'].label = 'Gerð'
        self.fields['OpenDate'].widget = widgets.AdminSplitDateTime()
	self.fields['CloseDate'].widget = widgets.AdminSplitDateTime()
        
class UserForm(ModelForm):
    class Meta:
        model = User
	fields = ['username', 'first_name', 'last_name', 'email']

class UserProfileForm(ModelForm):
    class Meta:
        model = UserProfile
	fields = ['SSN', 'PhoneNumer']
