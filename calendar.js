// {{{ docs <-- this is a VIM (text editor) text fold

// }}}
// {{{ settings (Editable)

var calendarWindow = null;
var calendarColors = new Array();
calendarColors['bgColor'] = '#FFFFF0';//'#BDC5D0';
calendarColors['borderColor'] = '#333366';
calendarColors['headerBgColor'] = '#398AD6';
calendarColors['headerColor'] = '#FFFFFF';
calendarColors['dateBgColor'] = '#FF9933';
calendarColors['dateColor'] = '#004080';
calendarColors['dateHoverBgColor'] = '#FFFFFF';
calendarColors['dateHoverColor'] = '#8493A8';
var calendarMonths = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
var calendarWeekdays = new Array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
var calendarUseToday = true;
var calendarFormat = 'd/m/y';
var calendarStartMonday = true;

// }}}
// {{{ getCalendar()

function getCalendar(in_dateField) 
{
    if (calendarWindow && !calendarWindow.closed) {
        //alert('Calendar window already open.  Attempting focus...');
        try {
            calendarWindow.focus();
        }
        catch(e) {}
        
        return false;
    }

    var cal_width = 290;  //415;
    var cal_height = 210;  //310;

    // IE needs less space to make this thing
    if ((document.all) && (navigator.userAgent.indexOf("Konqueror") == -1)) {
        cal_width = 290;//410;
    }

    calendarTarget = in_dateField;
    calendarWindow = window.open('calendar.html', 'dateSelectorPopup','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=0,dependent=no,width='+cal_width+',height='+cal_height);
    calendarWindow.focus();
    return false;
}

// }}}
// {{{ killCalendar()

function killCalendar() 
{
    if (calendarWindow && !calendarWindow.closed) {
	    
        calendarWindow.close();
		
    }
}

// }}}
