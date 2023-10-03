from django.shortcuts import render,redirect
from django.contrib.auth.models import User,auth
from django.conf import settings
from django.http import JsonResponse
from .models import tbl_customer
# Create your views here.
def index(request):
    return render(request,'index.html')
def register(request):
    if request.method=="POST":
        customer_name=request.POST['username']
        customer_email=request.POST['email']
        customer_phone=request.POST['phone_number']
        customer_password=request.POST['password']

        obj=tbl_customer()
        obj.customer_name=customer_name
        obj.customer_email=customer_email
        obj.customer_phone=customer_phone
        obj.customer_password=customer_password
        #user=User.objects.create_user(username=customer_name,email=customer_email,password=customer_password)
        #user=tbl_customer.customer_phone=customer_phone
        obj.save()
        return redirect('/loginn')
    else:
        return render(request,'register.html')
    
def loginn(request):
    return render(request,'login.html')
def seller_register(request):
    return render(request,'seller_register.html')
def pan_verification(request):
    return render(request,'pan_verification.html')
def selling_homepage(request):
    return render(request,'selling_homepage.html')

