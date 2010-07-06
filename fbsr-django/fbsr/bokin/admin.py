from django.contrib import admin
from fbsr.bokin.models import Event, Division, UserProfile

#class EventAdmin(admin.ModelAdmin):
#  fields = ['Division', 'Name']


admin.site.register(Division) 
admin.site.register(Event) 
admin.site.register(UserProfile)