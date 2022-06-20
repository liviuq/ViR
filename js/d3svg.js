fetch(`https://vira3.herokuapp.com/api/stat/svg.php`)
    .then((res) => res.json())
    .then((data) => {
        let temp_data = data['data'];
        console.log(temp_data);

        

        // const width = 900;
        // const height = 450;
        // const margin = { top: 50, bottom: 50, left: 50, right: 50 };

        // const svg = d3.select('#d3-container')
        //     .append('svg')
        //     .attr('width', width - margin.left - margin.right)
        //     .attr('height', height - margin.top - margin.bottom)
        //     .attr("viewBox", [0, 0, width, height]);

        // const x = d3.scaleBand()
        //     .domain(d3.range(temp_data.length))
        //     .range([margin.left, width - margin.right])
        //     .padding(0.1)
        
        // var aux =0;
        // for(i=0;i<temp_data.length;i++){
        //     if(temp_data[i].count>aux){
        //         aux=temp_data[i].count;
        //     }
        // }
        // const y = d3.scaleLinear()
        //     .domain([0, aux])
        //     .range([height - margin.bottom, margin.top])

        // svg
        //     .append("g")
        //     .attr("fill", 'royalblue')
        //     .selectAll("rect")
        //     .data(temp_data.sort((a, b) => d3.descending(a.count, b.count)))
        //     .join("rect")
        //     .attr("x", (d, i) => x(i))
        //     .attr("y", d => y(d.count))
        //     .attr('title', (d) => d.rating)
        //     .attr("class", "rect")
        //     .attr("height", d => y(0) - y(d.count))
        //     .attr("width", x.bandwidth());

        //     function yAxis(g) {
        //         g.attr("transform", `translate(${margin.left}, 0)`)
        //           .call(d3.axisLeft(y).ticks(null, temp_data.format))
        //           .attr("font-size", '20px')
        //       }
              
        //       function xAxis(g) {
        //         g.attr("transform", `translate(0,${height - margin.bottom})`)
        //           .call(d3.axisBottom(x).tickFormat(i => temp_data[i].rating))
        //           .attr("font-size", '20px')
        //       }
        //       svg.append("g").call(xAxis);
        //       svg.append("g").call(yAxis);
        //     svg.node();



        // const div = document.createElement('div');
        //     div.setAttribute('class', 'comment');

        // <svg class="chart" width="4200" height="150">
        //         <g class="bar">
        //             <text x="0" y="30" dy=".35em">nota 10</text>
        //             <rect x ="55" width="40" height="19" y="20" ></rect>
        //         </g>
        //     </svg>

        // var sorted = arr.sort(function (a, b) {
        //     return a.id - b.id || a.date.split('-').reverse().join('') - b.date.split('-').reverse().join('');
        // });

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

                div.appendChild(div1);
                div1.appendChild(div2);
                div1.appendChild(div3);
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


