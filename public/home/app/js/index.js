// Accordion
const accordionButtons = document.querySelectorAll(".accordion__button");

accordionButtons.forEach((button) => {
  button.addEventListener("click", () => {
    // toggle class active to accordion
    button.parentElement.classList.toggle("active");

    const iconButton = button.querySelector(".accordion__icon img");

    // toggle accordion button icon
    if (iconButton.src.includes("icon-expand.svg")) {
      iconButton.src = "./public/home/assets/icon-collapse.svg";
    } else {
      iconButton.src = "./public/home/assets/icon-expand.svg";
    }
  });
});

// Team Staffs
const teamStaffs = document.querySelectorAll(".team__staff");
const staffPrevBtn = document.getElementById("staff-prev-btn");
const staffNextBtn = document.getElementById("staff-next-btn");

let staffCardExpandedIndex = 0;
expandStaffCardIndex(staffCardExpandedIndex);

teamStaffs.forEach((teamStaff, index) => {
  teamStaff.addEventListener("click", () => {
    staffCardExpandedIndex = index;
    expandStaffCardIndex(staffCardExpandedIndex);
  });
});

// prev btn
staffPrevBtn.addEventListener("click", () => {
  staffCardExpandedIndex -= 1;

  if (staffCardExpandedIndex < 0) {
    staffCardExpandedIndex = 0;
  }

  expandStaffCardIndex(staffCardExpandedIndex);
});

// next btn
staffNextBtn.addEventListener("click", () => {
  staffCardExpandedIndex += 1;

  if (staffCardExpandedIndex > teamStaffs.length - 1) {
    staffCardExpandedIndex = teamStaffs.length - 1;
  }

  expandStaffCardIndex(staffCardExpandedIndex);
});

function expandStaffCardIndex(n) {
  if (n === teamStaffs.length - 1) {
    staffNextBtn.classList.remove("active");
  } else {
    staffNextBtn.classList.add("active");
  }

  if (n === 0) {
    staffPrevBtn.classList.remove("active");
  } else {
    staffPrevBtn.classList.add("active");
  }

  for (let i = 0; i < teamStaffs.length; i++) {
    teamStaffs[i].classList.remove("active");
  }

  teamStaffs[staffCardExpandedIndex].classList.add("active");
}
