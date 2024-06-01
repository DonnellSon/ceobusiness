(async function(){
    const res = await fetch('https://restcountries.com/v3.1/all?fields=name&lang=fr')
    const countries = await res.json()
    // const coutriesSelects=document.querySelectorAll('.countries-select')
    // coutriesSelects.forEach((select)=>{
    //     countries.forEach(c=>{
    //         select.innerHTML+=`<option value="${c.name.common}">${c.name.common}</option>`
    //     })
        
    // })
    const autoCompleteJS = new autoComplete({
        selector: "#countries-select",
        placeHolder: "",
        data: {
            src: countries.map((c)=>c.name.common),
            cache: true,
        },
        resultsList: {
            element: (list, data) => {
                if (!data.results.length) {
                    // Create "No Results" message element
                    const message = document.createElement("div");
                    // Add class to the created element
                    message.setAttribute("class", "no_result");
                    // Add message text content
                    message.innerHTML = `<span>Found No Results for "${data.query}"</span>`;
                    // Append message element to the results list
                    list.prepend(message);
                }
            },
            noResults: true,
        },
        resultItem: {
            highlight: true
        },
        events: {
            input: {
                selection: (event) => {
                    const selection = event.detail.selection.value;
                    autoCompleteJS.input.value = selection;
                }
            }
        }
    });
    
    console.log(countries[0])
})()