Endomondo-Grabber
=================

A PHP script that fetches the length and duration of your workouts on Endomondo. This is what it does:

1.	Generates a widget (iframe) with a given time span, using your Endomondo user ID;
2.	Crawls down the iframe's DOM to get the length and duration for the provided time span;
3.	Saves those numbers into separate text files.