fetch(`https://vira3.herokuapp.com/api/stat/svg.php`)
    .then((res) => res.json())
    .then((data) => {
        let temp_data = data['data'];
        console.log(temp_data);

        //sortam dupa note
        var sorted = temp_data.sort(function(a,b){
            return a.rating-b.rating;
        });
        
        //pentru ca dimensiunea barchart sa fie proportionala
        var auxcount=0;
        for(i=0;i<sorted.length;i++){
            if(sorted[i].count>auxcount)
            {
                auxcount=sorted[i].count;
            }
        }
        var div =  document.createElementNS("http://www.w3.org/2000/svg", "svg");
            div.setAttribute('class', 'chart');
            div.setAttribute('width', '4200');
            div.setAttribute('height', '2000');

        var j=30;
        var j1=20;
        for(i=0;i<sorted.length;i++){
            var div1 = document.createElementNS("http://www.w3.org/2000/svg", "g");
                div1.setAttribute('class', 'bar');
        
            var div2 =  document.createElementNS("http://www.w3.org/2000/svg", "text");
                div2.setAttribute('x', '0');
                div2.setAttribute('y', j+i*20);
                div2.setAttribute('dy', '.35em');
                div2.textContent = 'nota ' + sorted[i].rating;
        
            var div3 =  document.createElementNS("http://www.w3.org/2000/svg", "rect");
                div3.setAttribute('x', '55');
                div3.setAttribute('width', '200'* (sorted[i].count)/auxcount);
                div3.setAttribute('height', '19');
                div3.setAttribute('y', j1+i*20);

            var div4 =  document.createElementNS("http://www.w3.org/2000/svg", "text");
                div4.setAttribute('x', '260');
                div4.setAttribute('y', j+i*20);
                div4.setAttribute('dy', '.35em');
                div4.textContent ='x'+sorted[i].count;

                div.appendChild(div1);
                div1.appendChild(div2);
                div1.appendChild(div3);
                div1.appendChild(div4);
        }

        // var div1 = document.createElementNS("http://www.w3.org/2000/svg", "g");
        //     div1.setAttribute('class', 'bar');
        
        // var div2 =  document.createElementNS("http://www.w3.org/2000/svg", "text");
        //     div2.setAttribute('x', '0');
        //     div2.setAttribute('y', '30');
        //     div2.setAttribute('dy', '.35em');
        //     div2.textContent = 'nota ' + temp_data[0].rating;
        
        // var div3 =  document.createElementNS("http://www.w3.org/2000/svg", "rect");
        //     div3.setAttribute('x', '55');
        //     div3.setAttribute('width', '40'* temp_data[0].count);
        //     div3.setAttribute('height', '19');
        //     div3.setAttribute('y', '20');

        // div.appendChild(div1);
        // div1.appendChild(div2);
        // div1.appendChild(div3);
        document.querySelector('body').appendChild(div);
    });


