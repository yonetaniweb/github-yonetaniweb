const options = {
  startVal: 1921,
  useEasing: false,
};
let demo = new CountUp('myTargetElement', 2026, options);
if (!demo.error) {
  demo.start();
} else {
  console.error(demo.error);
}