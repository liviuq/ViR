fetch(`https://vira3.herokuapp.com/api/stat/svg.php`)
    .then((res) => res.json())
    .then((data) => {
        let temp_data = data['data'];
        console.log(temp_data);

        

        const width = 900;
        const height = 450;
        const margin = { top: 50, bottom: 50, left: 50, right: 50 };

        const svg = d3.select('#d3-container')
            .append('svg')
            .attr('width', width - margin.left - margin.right)
            .attr('height', height - margin.top - margin.bottom)
            .attr("viewBox", [0, 0, width, height]);

        const x = d3.scaleBand()
            .domain(d3.range(temp_data.length))
            .range([margin.left, width - margin.right])
            .padding(0.1)
        
        var aux =0;
        for(i=0;i<temp_data.length;i++){
            if(temp_data[i].count>aux){
                aux=temp_data[i].count;
            }
        }
        const y = d3.scaleLinear()
            .domain([0, aux])
            .range([height - margin.bottom, margin.top])

        svg
            .append("g")
            .attr("fill", 'royalblue')
            .selectAll("rect")
            .data(temp_data.sort((a, b) => d3.descending(a.count, b.count)))
            .join("rect")
            .attr("x", (d, i) => x(i))
            .attr("y", d => y(d.count))
            .attr('title', (d) => d.rating)
            .attr("class", "rect")
            .attr("height", d => y(0) - y(d.count))
            .attr("width", x.bandwidth());

            function yAxis(g) {
                g.attr("transform", `translate(${margin.left}, 0)`)
                  .call(d3.axisLeft(y).ticks(null, temp_data.format))
                  .attr("font-size", '20px')
              }
              
              function xAxis(g) {
                g.attr("transform", `translate(0,${height - margin.bottom})`)
                  .call(d3.axisBottom(x).tickFormat(i => temp_data[i].rating))
                  .attr("font-size", '20px')
              }
              svg.append("g").call(xAxis);
              svg.append("g").call(yAxis);
            svg.node();

    });


