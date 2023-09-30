from django.shortcuts import render

# Create your views here.
def index(request):
    return render(request,'index.html')
def register(request):
    return render(request,'register.html')
def loginn(request):
    return render(request,'login.html')
def seller_register(request):
    return render(request,'seller_register.html')