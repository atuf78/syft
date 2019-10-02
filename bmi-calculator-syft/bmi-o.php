<?php

$Content = '';
$Hidden = '';
if($atts['popup'])
{
	$Content .= '<a data-fancybox="bmi-container" data-src="#bmi-container" href="javascript:;" class="btn btn-primary">
    BMI Calculator
</a>';
	$Hidden = 'hidden';
}
$Content .= '<div class="bmi-container" id="bmi-container" '.$Hidden.'>
		<form>
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
						<div class="form-inline" hidden>
							<label>Height</label>
							<div class="form-group">
								<input type="text" name="ht" class="form-control">
							</div>
							<div class="form-group">
								<select class="form-control" name="hu" onChange="inchesCm(this.form)">
									<option selected>Inches</option>
									<option>CM</option>
								</select>
							</div>

						</div>
						<div class="form-inline">
							<label>Height</label>
							<div class="form-group" style="max-width: 40%;">
								<input name="htf" class="form-control" placeholder="5\'" onChange="feetAndInches(this.form)">
							</div>
							<div class="form-group" style="max-width: 40%;">
								<input name="hti" class="form-control" placeholder="6\'\'" onChange="feetAndInches(this.form)">
							</div>
							
						</div>
						
					</div>
					<div class="col-md-4">
						<div class="form-inline">
							<label>Weight</label>
							<div class="form-group">
								<input type="text" class="form-control" name="wt" value="68">
							</div>
							<div class="form-group">
								<div class="form-group">
									<select class="form-control" name="wu" onChange="poundsAndKilos(this.form)">
										<option>Pounds</option>
										<option selected>Killograms</option>
										
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Age (Years)</label>
							<input type="number" class="form-control" name="Years" placeholder="25">
							<select size="1" name="AgeCat" onChange="SetAge(this.form)" hidden>
                                <option>70 + years</option>
                                <option>60 - 69 yrs</option>
                                <option>50 - 59 yrs</option>
                                <option>40 - 49 yrs</option>
                                <option>30 - 39 yrs</option>
                                <option>20 - 29 yrs</option>
                                <option>18 - 19 yrs</option>
                                <option>17 yrs</option>
                                <option>16 yrs</option>
                                <option>15 yrs</option>
                                <option>14 yrs</option>
                                <option>13 yrs</option>
                                <option>12 yrs</option>
                                <option>11 yrs</option>
                                <option>10 yrs</option>
                                <option>9 yrs</option>
                                <option>8 yrs</option>
                                <option>7 yrs</option>
                                <option>6 yrs</option>
                                <option>5 yrs</option>
                                <option>4 yrs</option>
                                <option>3 yrs</option>
                                <option>2 yrs</option>
                                <option>1.5 yrs</option>
                                <option>1 yrs</option>
                                <option selected>Adult</option>
                                <option>Child</option>
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
				<h2 style="position: relative;">Activity Level<div class="help-tip">
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
				<button type="button" class="btn btn-info" id="calc" onclick="Exec(this.form)" style="margin: auto;">Calculate</button>
			
		</div>
		<div class="bmi-result" hidden>
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
		<select size="1" name="cdc" onChange="CalcIt(this.form)" hidden>
            <option>WHO - CDC</option>
            <option selected>halls.md v2</option>
        </select>
        <input type="hidden" name="kgcmP">
		</form>
	</div>';