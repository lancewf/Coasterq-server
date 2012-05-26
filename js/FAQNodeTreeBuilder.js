/**
 * @author lancewf
 */
function FAQNodeTreeBuilder()
{
	this.buildTree = function(listener)
	{
		var displayer = new FAQNodeDisplayer();
		
		var root = new Node();
		root.setListener(listener);
		root.setName("");
		root.setIsLeaf(false);
		root.setDisplayer(displayer);
		
		root.addChild(this._buildFirst(listener, displayer));
		root.addChild(this._buildSecond(listener, displayer));
		root.addChild(this._buildThird(listener, displayer));
		root.addChild(this._build4(listener, displayer));
		root.addChild(this._build5(listener, displayer));
		root.addChild(this._build6(listener, displayer));
				
		return root;
	}
	
	this._buildFirst = function(listener, displayer)
	{
		var question = new Node();
		question.setName("How are the wait times calculated?");
		question.setIsLeaf(false);
		question.setListener(listener);
		question.setDisplayer(displayer);
		
		var answer = new Node();
		answer.setName(
		"CoasterQ’s formula for calculating ride wait times consists of a two step process. The initial step involves a prediction technique which incorporates specific attributes of the park (this includes crowd levels along with many other factors) and historical data* to provide an approximate wait time. The second step is where CoasterQ’s user community comes into play – the base times are then refined by user entered wait times. Since the wait time calculation incorporates historical data, user-entered times will improve displayed times for the remainder of the current day as well as all future dates. The more wait times that users enter into the system, the more precise the times displayed will become, so tell your friends, family, and the people next to you in line to help out. Hey, you’re in line - got something better to do?"
		+ "<br /> <br />* Historical data consists of prior user-entered wait times; this includes wait times entered earlier for the current day as well as all entries made into the CoasterQ system on previous days/years.");
		answer.setIsLeaf(true);
		answer.setListener(listener);
		answer.setDisplayer(displayer);
		
		question.addChild(answer);

		return question;
	}
	
	this._buildSecond = function(listener, displayer)
	{
		var question = new Node();
		question.setName("Why is there a wait time for a ride that is closed? (Why are times displayed for hours that the park is closed?)");
		question.setIsLeaf(false);
		question.setListener(listener);
		question.setDisplayer(displayer);
		
		var answer = new Node();
		answer.setName(
		"CoasterQ’s formula for calculating attraction wait times uses historical wait time data, factors such as crowd level, and user-entered wait times (see above question on how wait times are calculated). The time predicted without user-entered wait times is known as the base time; when a ride is closed during regular park hours, the base time is the time that will be displayed. "
		+"Currently, attractions that are closed for short or long periods of time will display the base time (this will also occur when parks are closed seasonally or for holidays). We are working to list attractions as closed if they are going to be down for a long period of time. "
		+"Base times may be displayed during hours that the park is not opened to the public. CoasterQ remains open for unscheduled private parties and random events such as Grad Night. "
		+"As we expand to include more parks it will greatly benefit CoasterQ if users notify us of attraction closures, new attraction openings, and name changes.");
		answer.setIsLeaf(true);
		answer.setListener(listener);
		answer.setDisplayer(displayer);
		
		question.addChild(answer);

		return question;
	}
	
	this._buildThird = function(listener, displayer)
	{
		var question = new Node();
		question.setName("Should I enter the time I actually stood in line or the wait time displayed?");
		question.setIsLeaf(false);
		question.setListener(listener);
		question.setDisplayer(displayer);
		
		var answer = new Node();
		answer.setName(
		"There is no requirement for when a wait time must be entered. If you choose to enter the time you see displayed at the entrance to the ride, then you will want to enter the time of day at which that time is displayed. If you choose to enter the length of time you stood in line, then you will want to enter the time of day that you entered the line."
		+ "Wait times for rides can be entered up to 3 hours after the current time of day, so if you have forgotten to enter a wait time for a previous time of day you may go back and add that entry.");
		answer.setIsLeaf(true);
		answer.setListener(listener);
		answer.setDisplayer(displayer);
		
		question.addChild(answer);

		return question;
	}
	
	this._build4 = function(listener, displayer)
	{
		var question = new Node();
		question.setName("Do I have to refresh my browser to get new times?");
		question.setIsLeaf(false);
		question.setListener(listener);
		question.setDisplayer(displayer);
		
		var answer = new Node();
		answer.setName(
		"CoasterQ's wait times are automatically updated and displayed while you are connected to the internet. You do not need to refresh your browser.");		answer.setIsLeaf(true);
		answer.setListener(listener);
		answer.setDisplayer(displayer);
		
		question.addChild(answer);

		return question;
	}
	
	this._build5 = function(listener, displayer)
	{
		var question = new Node();
		question.setName("Will the itinerary (My Q) be erased if I switch parks or create an itinerary for another park?");
		question.setIsLeaf(false);
		question.setListener(listener);
		question.setDisplayer(displayer);
		
		var answer = new Node();
		answer.setName(
		"A ride queue can be created for each park. If you change parks your queue will be available to you upon returning to that park’s page. ");		
		answer.setIsLeaf(true);
		answer.setListener(listener);
		answer.setDisplayer(displayer);
		
		question.addChild(answer);

		return question;
	}
	
	this._build6 = function(listener, displayer)
	{
		var question = new Node();
		question.setName("Who do I contact if I want to see a certain theme park  on this site?");
		question.setIsLeaf(false);
		question.setListener(listener);
		question.setDisplayer(displayer);
		
		var answer = new Node();
		answer.setName(
		"We can be reached at support@coasterq.com or by clicking on the Contact Us link at the bottom of any page on CoasterQ");		
		answer.setIsLeaf(true);
		answer.setListener(listener);
		answer.setDisplayer(displayer);
		
		question.addChild(answer);

		return question;
	}
}
