function fireEvent(node, eventName) {
    // Make sure we use the ownerDocument from the provided node to avoid cross-window problems
    var doc;
    if (node.ownerDocument) {
        doc = node.ownerDocument;
    } else if (node.nodeType == 9){
        // the node may be the document itself, nodeType 9 = DOCUMENT_NODE
        doc = node;
    } else {
        throw new Error("Invalid node passed to fireEvent: " + node.id);
    }

     if (node.dispatchEvent) {
        // Gecko-style approach (now the standard) takes more work
        var eventClass = "";

        // Different events have different event classes.
        // If this switch statement can't map an eventName to an eventClass,
        // the event firing is going to fail.
        switch (eventName) {
            case "click": // Dispatching of 'click' appears to not work correctly in Safari. Use 'mousedown' or 'mouseup' instead.
            case "mousedown":
            case "mouseup":
                eventClass = "MouseEvents";
                break;

            case "focus":
            case "change":
            case "blur":
            case "select":
                eventClass = "HTMLEvents";
                break;

            default:
                throw "fireEvent: Couldn't find an event class for event '" + eventName + "'.";
                break;
        }
        var event = doc.createEvent(eventClass);
        event.initEvent(eventName, true, true); // All events created as bubbling and cancelable.

        event.synthetic = true; // allow detection of synthetic events
        // The second parameter says go ahead with the default action
        node.dispatchEvent(event, true);
    } else  if (node.fireEvent) {
        // IE-old school style, you can drop this if you don't need to support IE8 and lower
        var event = doc.createEventObject();
        event.synthetic = true; // allow detection of synthetic events
        node.fireEvent("on" + eventName, event);
    }
};
function syft_bmi_calc(a, b) {
    var c = document.forms.syft_bmiForm,
        d = 1 * c.w_v.value,
        e = c.w_u.options[c.w_u.selectedIndex].value,
        f = c.h_ft.value,
        g = c.h_in.value,
        h = 1 * c.h_v.value,
        i = c.h_u.options[c.h_u.selectedIndex].value,
        j = "";
    if ((!d || d < 5 || d > 600) && (j += "Weight value is missing or invalid.\n"), h ? (syft_is_n(h) || (j += "Height must be a number.\n"), (f || c.h_in.selectedIndex > 0) && (j += "Please choose only one method for height (ft+in, OR inches/cm).")) : syft_is_n(f) && 0 != c.h_in.selectedIndex || (j += "Height value is missing or invalid."), j) return alert(j), !1;
    "kg" == e && (d *= 2.20462262), "stn" == e && (d *= 14), h ? "cm" == i && (h *= .393700787) : h = 12 * f + 1 * g;
    var k = Math.round(d / (h * h) * 703 * 10) / 10,
        l = "";
    l = k < 16.5 ? "Severely Underweight" : k >= 16.5 && k < 18.5 ? "Underweight" : k >= 18.5 && k < 25 ? "Normal" : k >= 25 && k < 30 ? "Overweight" : "Obese", //l = "Your Body Mass Index is " + k + ". This is considered <strong>" + l + "</strong>.",
    c.bmi.value = k;
    c.interp.value = l;
    fireEvent(c.bmi, 'change');
    fireEvent(c.interp, 'change');
    //console.log(l);
}

function syft_is_n(a) {
    return !isNaN(a) && null != a && 0 != a.length && (a += "", a.search(/\s+/) == -1)
}
if (document.layers && !document.getElementById) document.write("Sorry, to view the BMI calculator you must use a newer browser.<p />");
else if ("undefined" == typeof syft_ttl) var syft_ttl = 1;