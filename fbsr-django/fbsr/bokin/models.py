# -*- coding: latin-1 -*-
from django.db import models
from django.contrib.auth.models import User
from django.contrib.admin import widgets

import datetime

class MyUser(models.Model):
    name = models.CharField(max_length=25)
    class Meta:
        db_table = "jos_users"

class UserProfile(models.Model):
    SSN = models.CharField(max_length=25)    
    ImageUrl = models.URLField()
    PhoneNumer = models.PositiveIntegerField()
    User = models.ForeignKey(MyUser)
    Unconfirmed = models.BooleanField()
    def __unicode__(self):
        return self.User.first_name
    class Meta:
        verbose_name = "notanda upplýsingar"
	verbose_name_plural = "notanda upplýsingar"
	
class Division(models.Model):
    User = models.ForeignKey(MyUser)
    Name = models.CharField(max_length=200)
    OpenDate = models.DateTimeField('deild stofuð')
    CloseDate = models.DateTimeField('deild lögð af', null=True, blank=True)
    def __unicode__(self):
        return self.Name
    def isAvailable(self):
        return self.CloseDate.date() > datetime.date.today()
    class Meta:
        verbose_name = "svið"
	verbose_name_plural = "svið"
	
class Asset(models.Model):
    User = models.ForeignKey(MyUser)
    Name = models.CharField('nafn búnaðar', max_length=200)    
    OpenDate = models.DateTimeField('búnaður stofnaður')
    CloseDate = models.DateTimeField('búnaði eytt', null=True, blank=True)
    def __unicode__(self):
        return self.Name
    def isAvailable(self):
        return self.CloseDate.date() > datetime.date.today()
    class Meta:
        verbose_name = "búnaður"
	verbose_name_plural = "búnaður"
	
class Event(models.Model):
    User = models.ForeignKey(MyUser)
    Division = models.ForeignKey(Division)
    Name = models.CharField('Nafn atburðar', max_length=200)
    OpenDate = models.DateTimeField('atburður hefst')
    CloseDate = models.DateTimeField('atburði lýkur', null=True, blank=True)
    def __unicode__(self):
        return self.Name
    def isAvailable(self):
        return self.CloseDate.date() > datetime.date.today()
    class Meta:
        verbose_name = "atburð"
	verbose_name_plural = "atburðir"
 
class EventRegistration(models.Model):
    User = models.ForeignKey(MyUser)
    Event = models.ForeignKey(Event)
    RegisteredDate = models.DateTimeField('skráning hefst')
    UnregisteredDate = models.DateTimeField('skráning lýkur', null=True, blank=True)

class AssetRegistration(models.Model):
    User = models.ForeignKey(MyUser)
    Asset = models.ForeignKey(Asset)
    LeasedDate = models.DateTimeField('leiga hefst')
    ReturnDate = models.DateTimeField('búnaði skilað', null=True, blank=True)
