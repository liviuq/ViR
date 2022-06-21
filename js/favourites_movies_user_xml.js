async function getFavJson(){
    const cookieValue = document.cookie
    .split('; ')
    .find(row => row.startsWith('token='))
    ?.split('=')[1];


const res = await fetch(`https://vira3.herokuapp.com/api/favourite/read_user_favourites.php`, {
    method: "GET",
    headers: {
        'Accept': 'application/json',
        'Content-type':'application/json',
        'Authorization': `Bearer ${cookieValue}`
    }
    });
    const reply = await res.json();
    console.log(reply);

    let output = OBJtoXML(reply);
    console.log(output);
    // var str= JSON.stringify(reply);
     document.body.appendChild(document.createElement("pre")).innerText=output;
}
getFavJson();
function OBJtoXML(obj) {
    var xml = '';
    for (var prop in obj) {
      xml += obj[prop] instanceof Array ? '' : "<" + prop + ">";
      if (obj[prop] instanceof Array) {
        for (var array in obj[prop]) {
          xml += "<" + prop + ">";
          xml += OBJtoXML(new Object(obj[prop][array]));
          xml += "</" + prop + ">";
        }
      } else if (typeof obj[prop] == "object") {
        xml += OBJtoXML(new Object(obj[prop]));
      } else {
        xml += obj[prop];
      }
      xml += obj[prop] instanceof Array ? '' : "</" + prop + ">";
    }
    var xml = xml.replace(/<\/?[0-9]{1,}>/g, '');
    return xml
  }
 