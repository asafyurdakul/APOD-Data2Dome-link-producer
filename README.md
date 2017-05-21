# APOD-Data2Dome-link-producer
The Data2Dome is a json standart created by ESO&amp;IPS efforts. "APOD" is Astronomy Picture of the Day site by NASA. 
The Planetarium software vendors can integrate Data2Dome standarts to their softwares. (ex. "Shira Universe" by www.sureyyasoft.com)
For now just ESO resources are hosting.
This project aimed to host Data2Dome json format "NASA APOD" daily images using a different web link.

#Usage:
Firstly, Get Your API Key from Open Nasa web site.
https://api.nasa.gov/index.html#live_example

Call metaapod.php file from hosting site parameters with "api_key" and "count" (Count parameters determines listed APOD image count)
Example call:
www.sureyyasoft.com/d2d/metaapod.php?api_key=DEMO_KEY&count=10

Note : Written on Open Nasa Web Site
DEMO_KEY Rate Limits :
Hourly Limit: 30 requests per IP address per hour
Daily Limit: 50 requests per IP address per day

Accounted Web Service Rate Limits:
Hourly Limit: 1,000 requests per hour
