var mId = document.getElementById('m_id');
var logo = document.getElementById('m_logo');
var tablerows = document.getElementById('m_table').rows;
mId.maxLength = 16;

class Brand{
	constructor(startings, source, maxLength, rowInTable){
		this.rowInTable = rowInTable;
		this.startings = startings;
		this.source = source;
		this.maxLength = maxLength;
	}
	have(num){
		for(var i in this.startings){
			if(num == this.startings[i]){
				return true;
			}
		}
		return false;
	}
};

var brand = [new Brand([4], "source/visa.jpg", 16, 0), new Brand([5, 51, 52, 53, 54, 55], "source/master.jpg", 16, 5), new Brand([30, 36, 38], "source/diners.jpg", 14, 2), new Brand([6, 6011, 65, 62], "source/discover.jpg", 16, 3), new Brand([34, 37], "source/express.jpg", 15, 1), new Brand([308, 309, 31, 3337,], "source/jcb.jpg", 16, 4), new Brand([2014, 2149], "source/enroute.jpg", 15, 6)];

document.getElementById('m_id').addEventListener('input', function (e) {
  var target = e.target, position = target.selectionEnd, length = target.value.length;
  target.value = target.value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1 ').trim();
  target.selectionEnd = position += ((target.value.charAt(position - 1) === ' ' && target.value.charAt(length - 1) === ' ' && length !== target.value.length) ? 1 : 0);
});

function validate(identify) {
	var identifier = identify;
	var it = 0;
	while(true){
		if(identifier[it] == " "){
			var a = identifier.substring(0, it);
			var b = identifier.substring(it + 1, identifier.length); 
			identifier = a.concat(b);
			it = 0;
		}
		it++;
		if(it >= identifier.length)break;
	}
	
	len = identifier.length;
	var sum = 0,
		alt = false,
		i = len-1,
		num;

	if (len < 13 || len > 19){
		return false;
	}

	while (i >= 0){
		num = parseInt(identifier.charAt(i), 10);
		if (isNaN(num)){
			return false;
		}
		if (alt) {
			num *= 2;
			if (num > 9){
				num = (num % 10) + 1;
			}
		} 
		alt = !alt;
		sum += num;
		i--;
	}
	return (sum % 10 == 0);
}

function search(){
	var val = (mId.value);
	if(val.length == 0){
		mId.style.backgroundColor = "#ffffff";
		logo.src = "//:0";
		for(var m in tablerows){
			tablerows[m].style.backgroundColor = "#ffffff";
		}
	}
	if(val[0] == "1" || val[0] == "7" || val[0] == "8" || val[0] == "9" || val[0] == "0"){
		logo.src = "//:0";
		mId.maxLength = 1;
	}
	
	if(!validate(val)){
		mId.style.backgroundColor = "#f4b3b4";
	} else {
		mId.style.backgroundColor = "#9be76b";
	}
	
	val = parseInt(mId.value);
	
	for (var i in brand){
		if(brand[i].have(val))
			{
				tablerows[brand[i].rowInTable + 1].style.backgroundColor = '#84b3e7';
				logo.src = brand[i].source;
				mId.maxLength = brand[i].maxLength + 3;
			}
	}
}
