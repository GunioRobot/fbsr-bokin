# -*- coding: latin-1 -*-
from django.forms import ModelForm
from django.contrib.admin import widgets                                       

from fbsr.bokin.models import Event


class EventForm(ModelForm):
    class Meta:
        model = Event
	fields = ['Division', 'Name', 'OpenDate', 'CloseDate']
    def __init__(self, *args, **kwargs):
        super(EventForm, self).__init__(*args, **kwargs)
	self.fields['Division'].label = 'Gerð'
        self.fields['OpenDate'].widget = widgets.AdminDateWidget()
	self.fields['CloseDate'].widget = widgets.AdminDateWidget()
        
