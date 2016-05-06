function Base64EncodeUrl(str){
    return str.replace(/\+/g, '-').replace(/\//g, '_').replace(/\=+$/, '');
}

function Base64DecodeUrl(str){
    str = (str + '===').slice(0, str.length + (str.length % 4));
    return str.replace(/-/g, '+').replace(/_/g, '/');
}

// Your Client ID can be retrieved from your project in the Google
// Developer Console, https://console.developers.google.com
var CLIENT_ID = '632784872848-kfca02of7742s9jkef12av9v405pqu7a.apps.googleusercontent.com';

var SCOPES = ['https://www.googleapis.com/auth/gmail.readonly'];

/**
 * Check if current user has authorized this application.
 */
function checkAuth() {
  gapi.auth.authorize(
    {
      'client_id': CLIENT_ID,
      'scope': SCOPES.join(' '),
      'immediate': true
    }, handleAuthResult);
}

function sendrequests() {
  var req = document.getElementById('phprequest');
  var requests = req.firstChild.nodeValue.split("___")
  var nReq = requests.length - 1
  var nRequest = new Array()

  for (var i=0; i<nReq; i++) {
    document.getElementById('printrequests').innerHTML = document.getElementById('printrequests').innerHTML + "\n" + requests[i]
  }

  // alert('Sent!')

  // Simultaneous JS XML HTTP Requests
  for (var i=0; i<nReq; i++){
     (function(i) {
        nRequest[i] = new XMLHttpRequest();
        // alert(requests[i])
        nRequest[i].open("GET", 'http://shuyangl.mycpanel2.princeton.edu/breakserv/upload.php?'+requests[i], true);
        if (i < nReq - 1) {
          nRequest[i].onreadystatechange = function (oEvent) {
           if (nRequest[i].readyState === 4) {
              if (nRequest[i].status === 200) {
                console.log(nRequest[i].responseText);
                //alert(nRequest[i].responseText);
              } else {
                console.log("Error", nRequest[i].statusText);
              }
           }
          };
        } else {
          nRequest[i].onreadystatechange = function (oEvent) {
            if (nRequest[i].readyState === 4) {
              if (nRequest[i].status === 200) {
                setTimeout(document.getElementById("autologin").submit(), 4000)
              } else {
                console.log("Error", nRequest[i].statusText);
              }
            }
          }
        }
        
        nRequest[i].send();
        // alert("sent!" + i)
        // appendPre('sent!' + i)
     })(i);
  }

  
}

/**
 * Handle response from authorization server.
 *
 * @param {Object} authResult Authorization result.
 */
function handleAuthResult(authResult) {
  var authorizeDiv = document.getElementById('authorize-div');
  if (authResult && !authResult.error) {
    // Hide auth UI, then load client library.
    authorizeDiv.style.display = 'none';
    loadGmailApi();
  } else {
    // Show auth UI, allowing the user to initiate authorization by
    // clicking authorize button.
    authorizeDiv.style.display = 'inline';
  }
}

/**
 * Initiate auth flow in response to user clicking authorize button.
 *
 * @param {Event} event Button click event.
 */
function handleAuthClick(event) {
  gapi.auth.authorize(
    {client_id: CLIENT_ID, scope: SCOPES, immediate: false},
    handleAuthResult);
  return false;
}

/**
 * Load Gmail API client library. List labels once client library
 * is loaded.
 */
function loadGmailApi() {
  gapi.client.load('gmail', 'v1', listMessagesW);
}

function listMessagesW() {
  req = gapi.client.gmail.users.getProfile({'userId': 'me'})
  req.execute(function(resp) {
    appendPre(resp.emailAddress + '\n')
  })
  var queryDate = new Date()
  // alert(queryDate.getFullYear().toString() + "/" + (queryDate.getMonth() + 1).toString() + "/" + queryDate.getDate().toString())
  // queryDate.setDate(queryDate.getDate() - 7)

  var lasttime = document.getElementById('lasttime').firstChild.nodeValue
  //alert(lasttime)
  if (lasttime == '1111-11-11') {
    queryDate.setDate(queryDate.getDate() - 7) // TESTING
    var day = queryDate.getDate()
    var month = queryDate.getMonth() + 1
    var year = queryDate.getFullYear()
    var dQ = "after:" + year.toString() + "/" + month.toString() + "/" + day.toString()
  } else {
    var day = lasttime.split('-')[2]
    var month = lasttime.split('-')[1]
    var year = lasttime.split('-')[0]
    var dQ = "after:" + year + "/" + month + "/" + day
  }

  //alert(dQ)
  // alert(lasttime)
  // return

  // alert(dQ)
  listMessages('me', 'subject:(study break) is:important ' + dQ, appendPre)
}

/**
 * Retrieve Messages in user's mailbox matching query.
 *
 * @param  {String} userId User's email address. The special value 'me'
 * can be used to indicate the authenticated user.
 * @param  {String} query String used to filter the Messages listed.
 * @param  {Function} callback Function to call when the request is complete.
 */
function listMessages(userId, query, callback) {
  appendPre(query)
  var getPageOfMessages = function(request, result, tR) {
    request.execute(function(resp) {
      result = result.concat(resp.messages);
      var nextPageToken = resp.nextPageToken;
      tR += resp.resultSizeEstimate;
      if (nextPageToken) {
        request = gapi.client.gmail.users.messages.list({
          'userId': userId,
          'pageToken': nextPageToken,
          'q': query
        });
        getPageOfMessages(request, result, tR);
      } else {
        appendPre(tR + " results found!\n");
        for (i=0; i < result.length; i++) {
          var msg = result[i]; // Only id, threadId
          var fullmsgrequest = gapi.client.gmail.users.messages.get({
            'userId': userId,
            'id': msg.id,
            'format': 'full'
          });
          // var bodyrequest = gapi.client.gmail.users.messages.get({
          //   'userId': userId,
          //   'id': msg.id,
          //   'format': 'raw'
          // });
          fullmsgrequest.execute(function(resp) {
            // Subject
            var subj = 'PLACEHOLDER'
            for (j=0; j < resp.payload.headers.length; j++) {
              if (resp.payload.headers[j].name === 'Subject') {
                subj = resp.payload.headers[j].value
              }
            }
            appendPre('')
            appendPre(subj)
            appendPre(resp.id)

            var bodytext = ""

            function recursivebody(parts_list) {
              var bodystring = ""
              for (j = 0; j < parts_list.length; j++) {
                var p = parts_list[j]
                if (p.mimeType.indexOf('multipart') > -1) {
                  var decoded = recursivebody(p.parts)
                  bodystring = bodystring + decoded
                }
                if (p.mimeType.indexOf('text') > -1) {
                  var decoded = window.atob(Base64DecodeUrl(p.body.data))
                  bodystring = bodystring + decoded
                }
              }
              return bodystring
            }

            var bodygrab = recursivebody(resp.payload.parts)
            bodytext = bodytext + bodygrab

            function uniques(arr) {
               if (arr.length < 1) {
                return null
               }
                var a = [];
                for (var i=0, l=arr.length; i<l; i++)
                    if (a.indexOf(arr[i]) === -1 && arr[i] !== '')
                        a.push(arr[i]);
                return a;
            }

            var date_of_email_sent = ""
            bodytext = bodytext.replace(/<[^>]+>/g, '')
            if (subj.indexOf('Fwd:') > -1) { // Forwarded email
              subj = subj.replace(/Fwd:\s/i, '')
              bodytext = bodytext.replace(/[\-]+ Forwarded message [\-]+/g, '')
              var dtf = bodytext.match(/From:.+Date:.+Subject:.+To:[ a-zA-Z&:;]*([a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?)/)
              if (dtf) {
                // alert(((dtf.join('')).match(/Date:.+Subject:/).join('')).slice(0,-8))
                var date_fwded = (dtf.join('')).match(/Date:.+Subject:/).join('').slice(0,-8)
                bodytext = bodytext.replace(/From:.+Date:.+Subject:.+To:[ a-zA-Z&:;]*([a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?)/, '')
              } else {
                var date_fwded = bodytext.match(/Date:[^\n]+\n/).join('')
              }
              var date_of_email_sent = date_fwded.match(/(Mon|Tue|Wed|Thu|Fri|Sat|Sun),\s(january|february|march|april|may|june|july|august|september|october|november|december|jan|feb|mar|apr|jun|jul|aug|sep|sept|oct|nov|dec)\s([012]?\d|30|31),\s\d\d\d\d/i)[0]
              bodytext = bodytext.replace(/From:[^\n]+\n/, '')
              bodytext = bodytext.replace(/Date:[^\n]+\n/, '')
              bodytext = bodytext.replace(/Subject:[^\n]+\n/, '')
              bodytext = bodytext.replace(/To:[^\n]+\n/, '')

              // appendPre(bodytext)
            } else {
              var hdrs = resp.payload.headers
              var dateval = "Mon, 10 Jan 0000"
              for (y=0;y<hdrs.length;y++) {
                if (hdrs[y].name == "Received") {
                  dateval = hdrs[y].value
                  break
                }
              }
              date_of_email_sent = dateval.match(/(Mon|Tue|Wed|Thu|Fri|Sat|Sun),\s([012]?\d|30|31)\s(january|february|march|april|may|june|july|august|september|october|november|december|jan|feb|mar|apr|jun|jul|aug|sep|sept|oct|nov|dec)\s\d\d\d\d/i)[0]
            }

            appendPre("DATE SENT: " + date_of_email_sent)

            // appendPre(bodytext)

            bodytext = subj + bodytext
            var pattern_date = /(today|tonight|tomorrow)(\s(morning|noon|afternoon|evening|night))?|((this|next)\s(monday|tuesday|wednesday|thursday|friday|saturday|sunday))|((monday|tuesday|wednesday|thursday|friday|saturday|sunday)(,\s?)?((january|february|march|april|may|june|july|august|september|october|november|december)(\s\d\d?))?)|(\d\d?\s(january|february|march|april|may|june|july|august|september|october|november|december))|((1|2|3|4|5|6|7|8|9|10|11|12)\/([012]?\d|30|31))|((january|february|march|april|may|june|july|august|september|october|november|december|jan|feb|mar|apr|jun|jul|aug|sep|sept|oct|nov|dec)\s?([012]?\d|30|31))[^\d]/gi
            var found_date = bodytext.match(pattern_date)
            if (found_date) {
              found_date = uniques(found_date.join('|').toLowerCase().split('|'))
            }
            // appendPre(found_date)
            // appendPre(bodytext.match(pattern_date))
            // var found_date = uniques(bodytext.match(pattern_date).join('|').toLowerCase().split('|'))
            var pattern_time = /((1[012]|[1-9])(:[0-5][0-9])?(\s)?(am|pm)?(\s)?(\-|to)(\s)?)?(1[012]|[1-9])(:[0-5][0-9])?(\s)?(am|pm)/gi
            var found_time = bodytext.match(pattern_time)
            if (found_time) {
              found_time = uniques(found_time)
            }
            // appendPre(found_time)

            var pattern_food = /hoagies*|([a-zA-Z])*foods*|food|boba|bubbles*|tea|sushi|chipotle|qdoba|tacos*|crepes*|drinks*|yogurt|fruity*|pizza|wings*|cupcakes*|pretzels*|burgers*|indian|waffles*|chinese|italian|samosas*|rice|sodas*|dippin(\'|g|&#39;)*(\s)dots|ice(\s)cream|tea|coffee|s(\'|&#39;)*mores|chick\-fil\-a|chicken|duck|barbeque|bbq|ice|burritos*|starbucks|juice|sandwich(es)?|say(\s)cheez|baklava|muffins*|brownies*/gi
            var found_food = bodytext.match(pattern_food)
            if (found_food) {
              found_food = uniques(found_food.join('|').toLowerCase().split('|'))
            }
            // var found_food_pre = bodytext.match(pattern_food)
            // var found_food = uniques(found_food_pre.join('|').toLowerCase().split('|'))

            var pattern_place = /(Frist(\s)?([0-9]*)?(\sCenter)?|([0-9]*\s)?Frist(\sCampus)?(\sCenter)?|Cap\s([&]|and)\sGown(\sClub)?|E(\-|ngineering)?(\s)?Quad(rangle)?|Studio\s?(&#39;|\')34|Mathey(\s)?(Common(\s)Room)?|Blair(\sHall)?|Edwards(\sHall)?|Hamilton(\sHall)?|Joline(\sHall)?|Little(\sHall)?|Rocky(\sCollege)?|Buyers(\sHall)?|Campbell(\sHall)?|Bloomberg(\sHall)?|Bogle(\sHall)?|Wilf(\sHall)?|Nassau(\s)st(reet)?|Nassau(\sHall)?|Campus(\s)Club|Sherrerd(\sHall)?|1915(\s)?(Room|Hall)?|1967(\sHall)?|1976(\sHall)?|Holder(\sHall)?|Holder(\s)4B|Madison(\sHall)?|Witherspoon(\sHall)?|Wu(\sHall)?|Yoseloff(\sHall)?|Forbes(\sCollege)?|Whig(\sHall)?|Clio(\sHall)?|Maclean(\sHouse)?|Art(\s)Museum|Robertson(\sHall)?|Dodd(\sHall)?|Richardson|McCosh(\sHall|(\s)Health(\s)Center)?|Berlind(\sTheatre|\sTheater)?|Lewis(\sLibrary)?|Cannon(\s)Green|Career(\s)Services|Chapel|22(\s)Chambers(\s)St(reet)?|New(\s)south|Firestone(\sLibrary)?|West(\s)college|Garden(\sTheatre|\sTheater)|Prospect(\sHouse|\sGarden)?|Baker(\s)Rink|Dillon(\sGym(nasium)?)?|Jadwin(\sGym(nasium)?)?|Princeton(\s)Stadium|Roberts(\s)Stadium|1981(\s)Hall|Baker(\sHall)?|Community(\sHall)?|Fisher(\sHall)?|Lauritzen(\sHall)?|Hargadon(\sHall)?|Murley\-Pivirotto\sFamily\sTower|Wendell(\sHall)?|Mathey(\s)College|Butler(\sCollege)?|Wilson(\sCollege)?|Whitman(\sCollege)?|Rockefeller(\sCollege)?|1927\-Clapp\sHall|1937\sHall|1938\sHall|1939\sHall|Dodge(\-Osborn)?(\sHall)?|Feinberg(\sHall)?|Gauss(\sHall)?|Walker(\sHall)?|Wilcox(\sHall)?|1901\sHall|1903\sHall|Brown(\sHall)?|Cuyler(\sHall)?|Dod(\sHall)?|Foulke(\sHall)?|Henry(\sHall)?|Laughlin(\sHall)?|Lockhart(\sHall)?|Patton(\sHall)?|Pyne(\sHall)?|Scully(\sHall)?|Spelman(\sHall)?|Wright(\sHall)?|Grad(uate)?\sCollege|Bendheim(\scenter\sfor\sfinance)?|Berlind(\sTheatre|\sTheater)?|Bobst(\sHall)?|Bowen(\sHall)?|Burr(\sHall)?|Campbell\sField|CJL|Center\sfor\sJewish\sLife|Chancellor\sGreen|Charter(\sclub)?|Clarke\sField|Cleveland\sTower|Cloister(\sInn)?|Colonial(\sClub)?|(CS|Computer\sScience)(\sBuilding)?|Corwin(\sHall)?|Cottage(\sClub)?|DeNunzio\sPool|Dickinson(\sHall)?|Dillon\sCourt|(East)?(\s)?Pyne(\sHall)?|Feinberg(\sHall)?|(Carl\sA\.)?(\s)?Fields(\s)Center|Fitz(\-)?Randolph|Frick|Green\sHall|Guyot(\sHall)?|Hamilton(\sHall)?|Henry(\sHall|\sHouse)?|Icahn|Ivy(\sClub)?|Hoyt|Jones(\sHall)?|Labyrinth(\sBooks)?|Laughlin(\sHall)?|Lauritzen(\sHall)?|Lowrie(\sHouse)?|Maclean(\sHouse)?|MacMillan(\sBuilding)?|Madison(\sHall)?|Maeder(\sHall)?|Mccarter(\sTheater|\sTheatre)|McCormick(\sHall)?|McDonnell(\sHall)?|Mudd\sLibrary|Murray(\sTheater|\sTheatre)|Neuroscience\sInstitute|North\sGarage|Palmer(\sHouse)?|Peyton(\sHall)?|Poe\sField|Quad(rangle)?(\sClub)?|Schultz(\sLab)?|Scheide\sCaldwell(\sHouse)?|Shea\sRowing\sCenter|Streicker\sBridge|Stephens\s(Fitness\s)?Center|Terrace(\sClub)?|Tiger(\sInn)?|Tower(\sClub)?|U(\s)?(\-)?(\s)?Store|Wallace(\sHall)?|Walker(\sHall)?|Wendell(\sHall)?|West(\sCollege)?|West\sGarage|Woolworth(\sHall)?|Wyman(\sHall)?|Architecture(\sBuilding)?)/gi
            var found_place = bodytext.match(pattern_place)
            if (found_place) {
              found_place = uniques(found_place.join('|').toLowerCase().split('|'))
            }
            // var found_place_pre = bodytext.match(pattern_place)
            // var found_place = uniques(found_place_pre.join('|').toLowerCase().split('|'))

            // alert(found)
            // appendPre(bodytext)
            if (found_date) {
              // var date_encoded = window.btoa(found_date.join('|')))
              if (found_date[0].toLowerCase() == "tonight") {
                var found_date_disp = 'tonight (' + date_of_email_sent + ')'
                var date_encoded = encodeURIComponent(Base64EncodeUrl(window.btoa(date_of_email_sent)))
                // var date_encoded = encodeURIComponent("janedoe")
              } else if (found_date[0].toLowerCase() == "today") {
                var found_date_disp = 'tonight (' + date_of_email_sent + ')'
                var date_encoded = encodeURIComponent(Base64EncodeUrl(window.btoa(date_of_email_sent)))
                // var date_encoded = encodeURIComponent("janedoe")
              } else if (found_date[0].toLowerCase().indexOf("tomorrow") > -1) {
                // if (date_of_email_sent.test(/(Mon|Tue|Wed|Thu|Fri|Sat|Sun),\s(january|february|march|april|may|june|july|august|september|october|november|december|jan|feb|mar|apr|jun|jul|aug|sep|sept|oct|nov|dec)\s([012]?\d|30|31),\s\d\d\d\d/i)) {
                  var daynum = parseInt(date_of_email_sent.match(/([012]?\d|30|31),/)[0].match(/([012]?\d|30|31)/)[0])
                  var yrnum = parseInt(date_of_email_sent.match(/\d\d\d\d/)[0])
                  var mostr = date_of_email_sent.match(/(jan|feb|mar|apr|may|jun|jul|aug|sep|sept|oct|nov|dec)/i)[0].toLowerCase()
                  var mo2num = {'jan':0, 'feb':1, 'mar':2, 'apr':3, 'may':4, 'jun':5, 'jul':6, 'aug':7, 'sep':8, 'oct':9, 'nov':10, 'dec':11}
                  var monum = parseInt(mo2num[mostr])
                  var datedate = new Date()
                  datedate.setDate(daynum)
                  datedate.setFullYear(yrnum)
                  datedate.setMonth(monum)
                  datedate.setDate(datedate.getDate() + 1)
                  var found_date_disp = 'tomorrow (' + datedate.toDateString() + ')'
                  var date_encoded = encodeURIComponent(Base64EncodeUrl(window.btoa(datedate.toDateString())))
                  // var date_encoded = encodeURIComponent("janedoe")
              } else {
                var date_encoded = encodeURIComponent(Base64EncodeUrl(window.btoa(found_date[0])))
                // var date_encoded = encodeURIComponent("janedoe")
                var found_date_disp = found_date
              }
            } else {
              var date_encoded = encodeURIComponent("null")
            }
            appendPre('DATES FOUND: ' + found_date_disp)
            appendPre('TIMES FOUND: ' + found_time)
            appendPre('FOODS FOUND: ' + found_food)
            appendPre('PLACE FOUND: ' + found_place)

            // Request string
            var subj_encoded = encodeURIComponent(Base64EncodeUrl(window.btoa(subj)))
            // var subj_encoded = encodeURIComponent("janedoe")
            // appendPre(subj + '\n' + subj_encoded)
            // appendPre(found_date + '\n' + date_encoded)
            if (found_time) {
              // var time_encoded = window.btoa(found_time.join('|')))
              var time_encoded = encodeURIComponent(Base64EncodeUrl(window.btoa(found_time[0])))
              // var time_encoded = encodeURIComponent("janedoe")
            } else {
              var time_encoded = encodeURIComponent("null")
            }
            // appendPre(found_time + '\n' + time_encoded)
            if (found_food) {
              var food_encoded = encodeURIComponent(Base64EncodeUrl(window.btoa(found_food.join('|'))))
              // var food_encoded = encodeURIComponent("janedoe")
            } else {
              var food_encoded = encodeURIComponent("null")
            }
            // appendPre(found_food + '\n' + food_encoded)
            if (found_place) {
              var firstplace = found_place[0]
              firstplace = firstplace.replace(/butler/gi, "butler college")
              firstplace = firstplace.replace(/wilson/gi, "wilson college")
              firstplace = firstplace.replace(/rocky/gi, "rockefeller college")
              firstplace = firstplace.replace(/rockefeller/gi, "rockefeller college")
              firstplace = firstplace.replace(/mathey/gi, "mathey college")
              firstplace = firstplace.replace(/forbes/gi, "forbes college")
              firstplace = firstplace.replace(/whitman/gi, "whitman college")

              // var place_encoded = window.btoa(found_place.join('|')))
              var place_encoded = encodeURIComponent(Base64EncodeUrl(window.btoa(firstplace)))
              // var place_encoded = encodeURIComponent("janedoe")
            } else {
              var place_encoded = encodeURIComponent("null")
            }

            var usrnm = encodeURIComponent(document.getElementById('username_hidden').innerHTML)

            var ludate = new Date().toISOString().slice(0, 19).replace('T', ' ');
            appendPre(ludate)
            appendPre(ludate.slice(0,10))
            // 2012-06-22 05:40:06 'YYYY-MM-DD HH:mm:ss'
            var lastupdate = encodeURIComponent(Base64EncodeUrl(window.btoa(ludate.slice(0,10))))

            // var usrnm = encodeURIComponent("janedoe")
            // alert(usrnm)

            // appendPre(found_place + '\n' + place_encoded)
            request_ind = 'name='+subj_encoded+'&date='+date_encoded+'&time='+time_encoded+'&food='+food_encoded+'&place='+place_encoded+"&user="+usrnm+"&lastupdate="+lastupdate
            appendPre(request_ind)

            var req = document.getElementById('phprequest');
            req.innerHTML = req.innerHTML + request_ind + "___"

          })
        }
      }
      setTimeout(sendrequests, 3000)
    });
  };
  var initialRequest = gapi.client.gmail.users.messages.list({
    'userId': userId,
    'q': query
  });
  getPageOfMessages(initialRequest, [], 0);
}

/**
 * Append a pre element to the body containing the given message
 * as its text node.
 *
 * @param {string} message Text to be placed in pre element.
 */
function appendPre(message) {
  var pre = document.getElementById('output');
  var textContent = document.createTextNode(message + '\n');
  pre.appendChild(textContent);
}