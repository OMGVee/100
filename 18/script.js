const p = document.querySelector('p');
function makeGreen() {
    p.style.color = '#BADA55';
}

const dogs = [{ name: 'Ghost', age: 2 }, { name: 'Hagi', age: 8 }];

/* console output examples */

//regular
console.log('regular console message');

//interpolated
console.log('string interpolated console message: %s', 'ABC');

//styled
console.log('%ccss styled console message', "font-style: italic; text-shadow: 1px 1px 0 blue; color:red");

//warning
console.warn('oh noes! warning console message');

//error
console.error('oh 💩! error console message');

//info
console.info('info console message');

//testing
console.assert(1===2, 'assert console message');

//clearing
//console.clear();

//DOM elems
console.log(p);
console.dir(p);

//grouping
dogs.forEach(dog=> {
    console.groupCollapsed(`${dog.name}`);
    console.log(`this is ${dog.name}`);
    console.log(`he is ${dog.age}`);
    console.groupEnd(`${dog.name}`);
})

//counting
console.count("👽");
console.count("👽");
console.count("👽");

//timing
console.time('label_operation');
//do stuff which takes time
function aaa() {
    for (i=0; i<20; i++) {
        console.log(i);
    }
}
aaa();
console.timeEnd('label_operation');

//table
console.table(dogs);