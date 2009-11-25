from django.contrib import admin
from fbsr.bokin.models import Event, Division, UserProfile

admin.site.register(Division) 
admin.site.register(Event) 
admin.site.register(UserProfile)