from django.urls import path,include
from . import views
urlpatterns = [
    path('', views.index,name="index"),
    path('register', views.register,name="register"),
    path('login', views.loginn,name="loginn"),
    path('seller_register', views.seller_register,name="seller_register"),
    path('pan_verification', views.pan_verification,name="pan_verification"),
    path('selling_homepage', views.selling_homepage,name="selling_homepage"),
  
]