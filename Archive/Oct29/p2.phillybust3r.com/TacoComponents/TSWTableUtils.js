/* Copyright 2009-2010 Taco Software. All rights reserved.
 * http://tacosw.com
 *
 * This file is part of the Component Library included in Taco HTML Edit.
 * Licensed users of Taco HTML Edit may modify and use this source code 
 * for their web development (including commercial projects), as long as 
 * this copyright notice is retained.
 *
 * The contents of this file may not be published in a format intended
 * for access by other humans, so you may not put code examples on a
 * web site with all or part of the contents of this file, and you may
 * not publish the contents of this file in a printed format.
 */


//Find tables with the class tswScrollableTable and tswTable,
//and invoke table initialization scripts.
function tswTableUtilsInit()
{
	var tables = document.getElementsByTagName('table');
	for(var i=0; i<tables.length; i++)
	{
		if(tables[i].className != null)
		{
			if(tables[i].className.indexOf('tswScrollableTable') != -1)
				tswTableUtilsInitScrollableTable(tables[i]);
			else if(tables[i].className.indexOf('tswTable') != -1)
				tswTableUtilsInitTable(tables[i]);
		}
	}
}

tswUtilsAddEventHandler(window, "load", tswTableUtilsInit);

function tswTableUtilsInitScrollableTable(element)
{
	tswTableUtilsInitTable(element);
	
	//Some code to make scrolling work in IE
	if(TSWBrowserDetect.browserMatches('Explorer', null, null))
	{
		//Set the table container to overflow: auto in IE
		element.parentNode.style.overflow = 'auto';
	}
}

function tswTableUtilsInitTable(element)
{
	// Mark the table rows with class names tswEvenRow and tswOddRow
	// for the alternating row styles. Also marks columns tswCol1,
	// tswCol2, etc.
	tswTableUtilsMarkAlternateRowsForTablesInElement(element);
	tswTableUtilsMarkColumnNumbersForTablesInElement(element);
}

//Invoke tswMarkAlternateRows for all tbody tags
//with class tswTableBody in the specified element
function tswTableUtilsMarkAlternateRowsForTablesInElement(element)
{
	if(element != null)
	{
		var tbodies = element.getElementsByTagName('tbody');
		for(var i=0; i<tbodies.length; i++)
		{
			tswTableUtilsMarkAlternateRows(tbodies[i]);
		}
	}
}

//Mark alternate tr tags with class tswEvenRow and tswOddRow.
function tswTableUtilsMarkAlternateRows(tbodyElement)
{
	var rows = TSWDomUtils.getChildrenWithTagName(tbodyElement, 'tr');
	for(var i=0; i<rows.length; i++)
	{
		rows[i].className = (i % 2 == 0) ? 'tswEvenRow' : 'tswOddRow';
	}
}

//Invoke tswMarkColumnNumbers for all tbody tags
//with class tswTableBody and thead tags with class
//tswTableHead in the specified element
function tswTableUtilsMarkColumnNumbersForTablesInElement(element)
{
	if(element != null)
	{
		var tbodies = element.getElementsByTagName('tbody');
		for(var i=0; i<tbodies.length; i++)
		{
			tswTableUtilsMarkColumnNumbers(tbodies[i]);
		}
		
		var theads = element.getElementsByTagName('thead');
		for(var i=0; i<theads.length; i++)
		{
			tswTableUtilsMarkColumnNumbers(theads[i]);
		}
	}
}

//Mark td/th tags with class tswCol1, tswCol2, etc.
function tswTableUtilsMarkColumnNumbers(element)
{
	var colTagName = element.tagName.toUpperCase() == 'THEAD' ? 'th' : 'td';
	var rows = TSWDomUtils.getChildrenWithTagName(element, 'tr');
	for(var i=0; i<rows.length; i++)
	{
		var cols = TSWDomUtils.getChildrenWithTagName(rows[i], colTagName);
		for(var j=0; j<cols.length; j++)
		{
			var className = 'tswCol'+(j+1);
			cols[j].className = className;
		}
	}
}


/* The checksum below is for internal use by Taco HTML Edit, 
   to detect if a component file has been modified.
   TacoHTMLEditChecksum: BCE01BA3 */