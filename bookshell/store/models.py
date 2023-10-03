from django.db import models

# Create your models here.
class tbl_customer(models.Model):
    customer_name=models.CharField(max_length=100)
    customer_email=models.EmailField(max_length=100)
    customer_phone=models.IntegerField
    customer_password=models.CharField(max_length=10)
    customer_status=True