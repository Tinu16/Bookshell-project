from django.shortcuts import render
import requests
from django.conf import settings
from django.http import JsonResponse

# Create your views here.
def index(request):
    return render(request,'index.html')
def register(request):
    return render(request,'register.html')
def loginn(request):
    return render(request,'login.html')
def seller_register(request):
    return render(request,'seller_register.html')
def pan_verification(request):
    return render(request,'pan_verification.html')
def selling_homepage(request):
    return render(request,'selling_homepage.html')

