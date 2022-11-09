// error div 
const errorBtn = () => {
    const allertDiv = document.getElementById("allartDiv");
    if (allertDiv.style.display == 'block') {
        allertDiv.style.display = 'none';
    }
    if (allertDiv.style.display = 'none') {
        allertDiv.style.display == 'block';
    }
}

const giveAllert = (message) => {
    console.log(message);
    document.getElementById("ErrorStatus").innerText = message;
    document.getElementById("allartDiv").style.display = "block";
}

function allowDrop(ev) {
    ev.preventDefault();
}

function dragStart(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function dragDrop2(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.append(document.getElementById(data));
}

function dragDrop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    const myCourseData = document.getElementById(ev.target.id).innerText;
    ev.target.append(document.getElementById(data));


    const id = ev.target.id;
    const courseText = document.getElementById(data).innerText;
    const infos = courseText.split(" ### ");
    if (infos[3] === 'T' || infos[3] === 'W') {
        // its theory course 
        handleTheory(infos, id, myCourseData);
    }
    else {
        // its lab course 
        handelLab(infos, id, myCourseData);
    }
}



let findDuplicates = arr => arr.filter((item, index) => arr.indexOf(item) != index);

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function handleTheory(courseData, id, myCourse) {
    const idParts = id.split("-");

    let sisterDay = '';
    if (idParts[1] == 0) {
        // checking placed in wrong day or not 
        if (courseData[2] !== "Sat") {
            giveAllert("Droped in wrong day");
            return;
            /// *** error detected *** ///
        }
        sisterDay = document.getElementById(idParts[0] + '-2').innerText;
    }
    else if (idParts[1] == 1) {
        if (courseData[2] !== "Sun") {
            giveAllert("Droped in wrong day");
            return;
        }
        sisterDay = document.getElementById(idParts[0] + '-3').innerText;
    }
    else if (idParts[1] == 2) {
        if (courseData[2] !== "Sat") {
            giveAllert("Droped in wrong day");
            return;
        }
        sisterDay = document.getElementById(idParts[0] + '-0').innerText;
    }
    else if (idParts[1] == 3) {
        if (courseData[2] !== "Sun") {
            giveAllert("Droped in wrong day");
            return;
        }
        sisterDay = document.getElementById(idParts[0] + '-1').innerText;
    }


    if (courseData[4] === "08:30:AM - 10:00:AM") {
        if (myCourse.includes("08:30:AM - 10:00:AM") || myCourse.includes("08:30:AM - 11:00:AM")) {
            giveAllert("Same time conflicts");
            return;
        }
        if (sisterDay.includes("08:30:AM - 10:00:AM") || sisterDay.includes("08:30:AM - 11:00:AM")) {
            giveAllert("Same time conflicts to its parallel day");
            return;
        }
    }

    else if (courseData[4] === "10:05:AM - 11:35:AM") {
        if (myCourse.includes("10:05:AM - 11:35:AM") || myCourse.includes("08:30:AM - 11:00:AM")) {
            giveAllert("Same time conflicts");
            return;
        }
        if (sisterDay.includes("10:05:AM - 11:35:AM") || sisterDay.includes("08:30:AM - 11:00:AM")) {
            giveAllert("Same time conflicts to its parallel day");
            return;
        }
    }

    else if (courseData[4] === "11:40:AM - 01:10:PM") {
        if (myCourse.includes("11:40:AM - 01:10:PM") || myCourse.includes("11:01:AM - 01:30:PM")) {
            giveAllert("Same time conflicts");
            return;
        }
        if (sisterDay.includes("11:40:AM - 01:10:PM") || sisterDay.includes("11:01:AM - 01:30:PM")) {
            giveAllert("Same time conflicts to its parallel day");
            return;
        }
    }

    else if (courseData[4] === "01:31:PM - 03:00:PM") {
        if (myCourse.includes("01:31:PM - 03:00:PM") || myCourse.includes("02:00:PM - 04:30:PM")) { //02:00:PM - 04:30:PM
            giveAllert("Same time conflicts");
            return;
        }
        if (sisterDay.includes("01:31:PM - 03:00:PM") || sisterDay.includes("02:00:PM - 04:30:PM")) {
            giveAllert("Same time conflicts to its parallel day");
            return;
        }
    }

    else if (courseData[4] === "03:01:PM - 04:30:PM") {
        if (myCourse.includes("03:01:PM - 04:30:PM") || myCourse.includes("02:00:PM - 04:30:PM")) {
            giveAllert("Same time conflicts");
            return;
        }
        if (sisterDay.includes("03:01:PM - 04:30:PM") || sisterDay.includes("02:00:PM - 04:30:PM")) {
            giveAllert("Same time conflicts to its parallel day");
            return;
        }
    }

}

function handelLab(courseData, id, myCourse) {
    const idParts = id.split("-");

    let sisterDay = '';
    if (idParts[1] == 0) {
        // checking placed in wrong day or not 
        if (courseData[2] !== "Sat") {
            giveAllert("Droped in wrong day");
            return;
            /// *** error detected *** ///
        }
        sisterDay = document.getElementById(idParts[0] + '-2').innerText;
    }
    else if (idParts[1] == 1) {
        if (courseData[2] !== "Sun") {
            giveAllert("Droped in wrong day");
            return;
        }
        sisterDay = document.getElementById(idParts[0] + '-3').innerText;
    }
    else if (idParts[1] == 2) {
        if (courseData[2] !== "Sat") {
            giveAllert("Droped in wrong day");
            return;
        }
        sisterDay = document.getElementById(idParts[0] + '-0').innerText;
    }
    else if (idParts[1] == 3) {
        if (courseData[2] !== "Sun") {
            giveAllert("Droped in wrong day");
            return;
        }
        sisterDay = document.getElementById(idParts[0] + '-1').innerText;
    }

    // find error in the parallel(sisterDay) 
    if (courseData[3] == "08:30:AM - 11:00:AM") {
        if (myCourse.includes("08:30:AM - 11:00:AM") || myCourse.includes("08:30:AM - 10:00:AM") || myCourse.includes("10:05:AM - 11:35:AM")) {
            giveAllert("Same time conflicts");
            return;
        }
        if (sisterDay.includes("08:30:AM - 10:00:AM") || sisterDay.includes("10:05:AM - 11:35:AM")) {
            giveAllert("Same time conflicts to its parallel day");
            return;
        }
    }
    else if (courseData[3] == "11:01:AM - 01:30:PM") {
        if (myCourse.includes("11:01:AM - 01:30:PM") || myCourse.includes("10:05:AM - 11:35:AM") || myCourse.includes("11:40:AM - 01:10:PM")) {
            giveAllert("Same time conflicts");
            return;
        }
        if (sisterDay.includes("10:05:AM - 11:35:AM") || sisterDay.includes("11:40:AM - 01:10:PM")) {
            giveAllert("Same time conflicts to its parallel day");
            return;
        }
    }
    else if (courseData[3] == "02:00:PM - 04:30:PM") {
        if (myCourse.includes("02:00:PM - 04:30:PM") || myCourse.includes("01:31:PM - 03:00:PM") || myCourse.includes("03:01:PM - 04:30:PM")) {
            giveAllert("Same time conflicts");
            return;
        }
        if (sisterDay.includes("01:31:PM - 03:00:PM") || sisterDay.includes("03:01:PM - 04:30:PM")) {
            giveAllert("Same time conflicts to its parallel day");
            return;
        }
    }
}
