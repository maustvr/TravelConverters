let host1, host2, host3, host4, apiKey2;

function fetchCurrencyDataAndInitialize() {
  $.ajax({
      url: 'getValues.php',
      type: 'GET',
      dataType: 'json',
      success: function(data) {

        // Use the returned data
        host1 = data.host1;
        host2 = data.host2;
        host3 = data.host3;
        host4 = data.host4;
        apiKey2 = data.apiKey2;
        // Call the function to initialize currency-related functionality
        var currencyDropdowns = document.getElementsByClassName('dropdown');
        var currencyDropdownExists = currencyDropdowns.length > 0;
        console.log(currencyDropdowns); // Change this line
        if (currencyDropdownExists) {
            populateCurrencyDropdown();
        }
             // populateCurrencyDropdown();
            
        
          //populateCurrencyDropdown();
          if (inputValue1 && !(inputValue1 instanceof HTMLInputElement) && inputValue2 && !(inputValue2 instanceof HTMLInputElement)) {
            initializeDateTime(inputValue1, inputValue2);
          }
          if (weatherloc1 && !(weatherloc1 instanceof HTMLInputElement) && weatherloc2 && !(weatherloc2 instanceof HTMLInputElement)) {
          console.log(weatherloc1);
          console.log(weatherloc2);
			      initializeWeather(weatherloc1, weatherloc2);
          }
      },
      error: function(xhr, status, error) {
          console.error('Error fetching values:', error);
      }
  });
}


// Call both functions when the document is ready
$(document).ready(function() {
  fetchCurrencyDataAndInitialize();
  
});

function populateCurrencyDropdown() {
    const select = document.querySelectorAll('.currency');
    fetch(host3)
        .then((response) => response.json())
        .then((data) => {
            const entries = Object.entries(data);
            for (let i = 0; i < entries.length; i++) {
                select[0].innerHTML += `<option value="${entries[i][0]}">${entries[i][0]} : ${entries[i][1]}</option>`;
                select[1].innerHTML += `<option value="${entries[i][0]}">${entries[i][0]} : ${entries[i][1]}</option>`;
            }
        })
        .catch((error) => {
            console.error('Error populating currency dropdown:', error);
        });
}

function convert(currency1, currency2, value) {
    fetch(`https://${host4}/latest?amount=${value}&from=${currency1}&to=${currency2}`)
        .then((response) => response.json())
        .then((data) => {
            const rate = Object.values(data.rates)[0];
            console.log(rate);
            output.value = rate;
            output.innerHTML = rate;
        })
        .catch((error) => {
            console.error('Error converting currency:', error);
        });
}

function updatevalue() {
    const select = document.querySelectorAll('.currency');
    const currency1 = select[0].value;
    const currency2 = select[1].value;
    const value = document.getElementById('number').value;
    convert(currency1, currency2, value);
}

	
//To convert chosen currencies


  function convert(currency1, currency2, value) {
    const host = "api.frankfurter.app";

    fetch(`https://${host4}/latest?amount=${value}&from=${currency1}&to=${currency2}`)
      .then((val) => val.json())
      .then((val) => {
        console.log(Object.values(val.rates)[0]);
        console.log(Object.values(val.rates)[0]);
        output.value = Object.values(val.rates)[0];
    const result = output.value;
    output.innerHTML = result;
      });

  }

	//unit calculators
	
	function updateMiles() {
		MiInput.value=(KmInput.value*0.62137).toFixed(1); 
		}
		
	function updateKm() {
		KmInput.value =(MiInput.value/0.62137).toFixed(1);
		}
		
	function updateMeters() {
		MeterInput.value =(FtInput.value*.3048).toFixed(1);
		}
		
	function updateFeet() {
		FtInput.value =(MeterInput.value*3.28).toFixed(1);
		}
		
	function updatePounds() {
		lbInput.value =(KgInput.value*2.20462262185).toFixed(1);
		}
		
	function updateKilograms() {
		KgInput.value =(lbInput.value*.45359237).toFixed(1);
		}
	
	
	
	//Time and Date comparison
	
  var button1 = document.querySelector('.button1');
 inputValue1 = document.querySelector('.inputValue1');
  var datetime1 = document.querySelector('.datetime1');
  var button2 = document.querySelector('.button2');  
  inputValue2 = document.querySelector('.inputValue2'); 
  var datetime2 = document.querySelector('.datetime2');
    
   
  document.addEventListener('DOMContentLoaded', function() {
    if (button1) {
          button1.addEventListener('click', function time() {
            const options = {method: 'GET'};
            inputValue1 = document.querySelector('.inputValue1');    
            var url1 = host1 + inputValue1.value;
            fetchTime(url1, datetime1);          
          });
      }
    
    if (button2) {
        button2.addEventListener('click', function time() {
          //console.log('clicked');
            const options = {method: 'GET'};
            inputValue2 = document.querySelector('.inputValue2'); 
          // var url2 = 'https://timezone.abstractapi.com/v1/current_time/?api_key=8deca98c64144d77b40aeda4694de42c&location=' + inputValue2.value;
            //time(url2, datetime2);
            var url2 = host1 + inputValue2.value;
            fetchTime(url2, datetime2);
        });
    }
    });
  
 
    function initializeDateTime(inputValue1, inputValue2){
      if (inputValue1 && inputValue2) {
      var time1 = document.querySelector('.datetime1'); 
      var url1 = host1 + inputValue1 + '';
      var time2 = document.querySelector('.datetime2');
      var url2 = host1 + inputValue2 + '';      
      fetchTime(url1, time1);
      setTimeout(function() {
        fetchTime(url2, time2);
      }, 6000); 
  }
}

    function fetchTime(url, datetime ){
      fetch(url)
    
          .then(response => {
              if (!response.ok) {
                  throw new Error('Network response was not ok');
              }
              return response.json();
          })
          .then(data => {
              var datetimeValue1 = data['datetime'];
              var parsedDate = new Date(datetimeValue1);
              if (isNaN(parsedDate)) {
                  throw new Error('Invalid date format received from the API');
              }
              var options = { weekday: "long", year: "numeric", month: "long", day: "numeric", hour: "numeric", minute: "numeric", second: "numeric" };
              var newdatetimeValue1 = parsedDate.toLocaleString('lan', options);
              datetime.textContent = newdatetimeValue1;

              var timeloc1Input = document.getElementById('timeloc1');
            var timeloc2Input = document.getElementById('timeloc2');

            
            if (typeof inputValue1 === 'string' && inputValue1.trim() !== "") {
              var timeloc1Input = document.getElementById('timeloc1');
              if (timeloc1Input) {
                  if (timeloc1Input.hasAttribute && timeloc1Input.hasAttribute('placeholder')) {
                      timeloc1Input.placeholder = inputValue1;
                  } else {
                      timeloc1Input.setAttribute('placeholder', inputValue1);
                  }
              }
          }
          
          if (typeof inputValue2 === 'string' && inputValue2.trim() !== "") {
            var timeloc2Input = document.getElementById('timeloc2');
            if (timeloc2Input) {
                if (timeloc2Input.hasAttribute && timeloc2Input.hasAttribute('placeholder')) {
                    timeloc2Input.placeholder = inputValue2;
                } else {
                    timeloc2Input.setAttribute('placeholder', inputValue2);
                }
            }
        }          
      })
      .catch(err => {
        alert("Error: " + err.message);
    });
  }

//Weather comparison

// Check if the weatherloc1 variable is set and if the button element exists

var buttonA = document.querySelector('.buttonA');
  var inputValueA = document.querySelector('.inputValueA');
  var city1 = document.querySelector('.city1');
  var desc1 = document.querySelector('.desc1');
  var tempC = document.querySelector('.tempC');
  var tempF = document.querySelector('.tempF');

  var buttonB = document.querySelector('.buttonB');
  var inputValueB = document.querySelector('.inputValueB');
  var city2 = document.querySelector('.city2');
  var desc2 = document.querySelector('.desc2');
  var tempC2 = document.querySelector('.tempC2');
  var tempF2 = document.querySelector('.tempF2');

  
  if(buttonA) {
      buttonA.addEventListener('click', function() {
      var urlCity1 = host2+inputValueA.value+apiKey2;
      fetchWeather(urlCity1, city1, tempC, tempF, desc1);
  });
}

  if(buttonB) {
    buttonB.addEventListener('click',function(){
    var urlCity2 = host2+inputValueB.value+apiKey2;    
    fetchWeather(urlCity2, city2, tempC2, tempF2, desc2);
  });

}

  //document.addEventListener('DOMContentLoaded', function() {

  function initializeWeather(weatherloc1, weatherloc2) {
    if (weatherloc1 && weatherloc2) {
    var city1 = document.querySelector('.city1');
    var desc1 = document.querySelector('.desc1');
    var tempC = document.querySelector('.tempC');
    var tempF = document.querySelector('.tempF');
    var city2 = document.querySelector('.city2');
    var desc2 = document.querySelector('.desc2');
    var tempC2 = document.querySelector('.tempC2');
    var tempF2 = document.querySelector('.tempF2');
    var url1 = host2+weatherloc1+apiKey2;
    var url2 = host2+weatherloc2+apiKey2;
    fetchWeather(url1, city1, tempC, tempF, desc1);
    console.log(city1);
    console.log(tempC);
    console.log(tempF);
    console.log(desc1);
    fetchWeather(url2, city2, tempC2, tempF2, desc2);
  }
}

  // Function to fetch weather data

  function fetchWeather(url, city, tempc, tempf, desc) {
  
    fetch(url)
      .then(response => response.json())
      .then(data => {
        var cityName = data['name'];
        var tempCValue = Math.round(data['main']['temp']);
        var tempFValue = Math.round(tempCValue * 9 / 5 + 32);
        var descValue = data['weather'][0]['description'];
        city.textContent = cityName;        
        tempc.textContent = tempCValue + ' °C';
        console.log(tempc);
        tempf.textContent = tempFValue + ' °F';
        desc.textContent = descValue;
      })
    
      .catch(err => alert("Error fetching weather data"));
    }
  


