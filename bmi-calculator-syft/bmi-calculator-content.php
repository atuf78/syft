<?php
$Ages = '';
for ($i=18; $i < 105; $i++) {
	$Selected = '';
	if($i == 23)
		$Selected = ' selected';
	$Ages .= '<option value="'.$i.'"'.$Selected.'>'.$i.'</option>';
}
$Content = '';
$Hidden = '';
if($atts['popup'])
{
	$Content .= '<a data-fancybox="bmi-container" data-src="#bmi-container" href="javascript:;" class="bmi-btn bmi-btn-primary">
    BMI Calculator
</a>';
	$Hidden = 'hidden';
}
$Content .= '<div class="bmi-container" id="bmi-container" '.$Hidden.'>
		<form id="syft_bmiForm" onsubmit="syft_bmi_calc();return false;">
		<div class="bmi-form">
			<div class="row">
				<div class="col-md-4">
					
				</div>
				<div class="col-md-4">
					<h1 class="m-0 text-center">BMI Calculator</h1>
				</div>
				<div class="col-md-4">
					<h3 id="reset" class="m-0 text-right">Reset</h3>
				</div>
			</div>
			<hr>
			
				<div class="row-no-gutters">
					<div class="col-md-4">
						<div class="form-inline">
							<label>Height
								<span id="hu" class="label-inline-vals">
									<a id="huin" data-v="ft" class="active">ft</a>
									<!-- <a id="huin" data-v="in">in</a> -->
									<a id="hucm" data-v="cm">cm</a>
								</span>
							</label>
							<div id="hfi">
								<div class="form-group" style="max-width: 40%;margin-right: -5px;">
									<input style="border-right: 0px;border-radius: 5px 0px 0px 5px;" name="h_ft" class="form-control" placeholder="5 feet">
								</div>
								<div class="form-group" style="max-width: 40%;">
									<input style="border-radius: 0px 5px 5px 0px;" name="h_in" class="form-control" placeholder="6 inches">
								</div>
							</div>
							<div id="hincm" style="display: none;">
								<div class="form-group">
									<input type="text" class="form-control" name="h_v" placeholder="cm">
								</div>
							</div>
							<select name="h_u" style="display: none;">
								<option value="ft" selected>ft</option>
								<option value="cm">cm</option>
								<option value="in">in.</option>
							</select>
						</div>
						
					</div>
					<div class="col-md-4">
						<div class="form-inline">
							<label>Weight
								<span id="wu" class="label-inline-vals">
									<a id="huin" data-v="kg" class="active">kg</a>
									<a id="hucm" data-v="lbs">lbs</a>
									<a id="hucm" data-v="stn">stn</a>
								</span>
							</label>
							<div class="form-group" id="w_v">
								<input type="text" class="form-control" name="w_v" placeholder="Kg">
							</div>
							<div class="form-group" style="display: none;">
								<div class="form-group">
									<select class="form-control" name="w_u">
										<option value="lbs">lbs</option>
										<option value="Kg" selected>Killograms</option>
										<option value="stn">Stone</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Age</label>
							<!-- <input type="number" class="form-control" name="Years" placeholder="25"> -->
							<select class="form-control" name="Years">
								'.$Ages.'
							</select>

						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<hr />
				<div class="row-no-gutters">
					<div class="col-md-4">
						<div class="form-group">
							<label>Sex <div class="help-tip">
				<p>For children, BMI centile is gender specific. For both children and adults, we give more personalised information based on whether you are male or female.</p>
			</div></label>
							<div class="form-inline">
								<div class="form-group custom-radio">
									<input type="radio" id="GenderMale" name="Gender" value="Male">
									<label for="GenderMale">Male</label>
									
								</div>
								<div class="form-group custom-radio">
									<input type="radio" id="GenderFemale" name="Gender" value="Female">
									<label for="GenderFemale">Female</label>
									
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="form-group">
							<label>Ethnic (Optional)<div class="help-tip">
				<p>Black, Asian and other minority ethnic groups with a BMI of 23 or more have a higher risk of getting type 2 diabetes and other long term illnesses</p>
			</div></label>
							<select id="antbits-bmi-ethnicity" class="form-control">
						        <option value="1">Not stated</option>
						        <option value="2">White</option>
						        <option value="3">Black Caribbean</option>
						        <option value="4">Black African</option>
						        <option value="5">Indian</option>
						        <option value="6">Pakistani</option>
						        <option value="7">Bangladeshi</option>
						        <option value="8">Chinese</option>
						        <option value="9">Middle Eastern</option>
						        <option value="10">Mixed</option>
						        <option value="11">Other</option>
						    </select>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<hr>
				<h2 style="position: relative;" id="activity-level">Activity Level<div class="help-tip">
				<p>Physical activity is anything that makes you breathe faster and feel warmer. It could be:
brisk walking
running
cycling
swimming
dancing
an active job
pushing a lawnmower
tennis
football</p>
			</div></h2>
				<p>So we can personlize your results.</p>
				<div id="double-label-slider"></div>
				<hr>
				<button type="button" class="btn btn-info" id="calc" onclick="syft_bmi_calc()" style="margin: auto;">Calculate</button>
			
		</div>
		<div class="bmi-result" style="display: none;">
			<div class="row">
				<div class="col-md-4">
					<h3 id="back" class="m-0 text-left">< BACK</h3>
				</div>
				<div class="col-md-4">
					<h1 class="m-0 text-center">BMI Result</h1>
				</div>
				<div class="col-md-4">
					<h3 id="resetnClose" class="m-0 text-right">Reset</h3>
				</div>
			</div>
			<hr>
			<div id="container"></div>
			<input maxLength="5" name="bmi" size="5" type="hidden">
			<input name="interp" type="hidden">
			<div id="interp">n/A</div>
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6 offset-md-3">
					<p class="text-center" style="margin-top: 15px;">Your health would really benifit from gradully loosing just <span>5</span>% of your current weight. The best way to loose weight is through a combination of diet and exercise.</p>
				</div>
			</div>
		</div>
		</form>
	</div>';