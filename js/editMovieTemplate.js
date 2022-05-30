//get the ID we pass in the URL
const queryString = window.location.search;
const urlParameters = new URLSearchParams(queryString);
console.log(urlParameters.get('id'));