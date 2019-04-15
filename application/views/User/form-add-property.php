<form role="form" style="width: 100%" action="<?php echo base_url(); ?>index.php/User/add_new_property" method="POST" enctype="multipart/form-data">
    <center><p><strong>SECTION A: PROPERTY OWNER’S DETAILS</strong></p></center>
    <div class="form-group">
        <label>Property Title</label>
        <input type="text" name="property_title" class="form-control">
    </div>
    <div class="form-group">
        <label>Title</label>
        <select name="owner_title" class="form-control">
            <option>Mr</option>
            <option>Mrs</option>
            <option>Dr</option>
            <option>M/s</option>
        </select>
    </div>
    <center><p><strong>PART I: NON-INDIVIDUAL OWNERSHIP DETAILS</strong></p></center>
    <div class="form-group">
        <label>Business Name</label>
        <input type="text" name="business_name" class="form-control">
    </div>
    <div class="form-group">
        <label>Legal Name</label>
        <input type="text" name="legal_name" class="form-control">
    </div>
    <div class="form-group">
        <label>Type of Company</label>
        <select name="type_of_company" class="form-control">
            <option>Private Company</option>
            <option>Public Company</option>
            <option>Parastatal</option>
            <option>MDA</option>
            <option>Estate or Trust</option>
            <option>Club, Society, or Partnership</option>
            <option>NGOs</option>
        </select>
    </div>
    <div class="form-group">
        <label>District</label>
        <input type="text" name="district" class="form-control">
    </div>
    <div class="form-group">
        <label>County</label>
        <input type="text" name="county" class="form-control">
    </div>
    <div class="form-group">
        <label>Sub-county/Division</label>
        <input type="text" name="subcounty" class="form-control">
    </div>
    <div class="form-group">
        <label>Parish</label>
        <input type="text" name="parish" class="form-control">
    </div>
    <div class="form-group">
        <label>Village</label>
        <input type="tex" name="village" class="form-control">
    </div>
    <center><p><strong>AUTHORIZED CONTACT PERSON</strong></p></center>
    <div class="form-group">
        <label>Title</label>
        <select name="contact_title" class="form-control">
            <option>Mr</option>
            <option>Mrs</option>
            <option>Dr</option>
            <option>M/s</option>
        </select>
    </div>
    <div class="form-group">
        <label>Surname</label>
        <input type="text" name="surname_contact" class="form-control">
    </div>
    <div class="form-group">
        <label>Firstname</label>
        <input type="text" name="firstname_contact" class="form-control">
    </div>
    <div class="form-group">
        <label>Mobile Number</label>
        <input type="text" name="mobile_contact" class="form-control">
    </div>
    <center><p><strong>PHYSICAL ADDRESS OF THE PROPERTY OWNER</strong></p></center>
    <div class="form-group">
        <label>County</label>
        <input type="text" name="county_owner" class="form-control">
    </div>                      
    <div class="form-group">
        <label>District</label>
        <input type="text" name="district_owner" class="form-control">
    </div>
    <div class="form-group">
        <label>Subcounty/Division</label>
        <input type="text" name="subcounty_owner" class="form-control">
    </div>
    <div class="form-group">
        <label>Parish/Ward</label>
        <input type="text" name="parish_owner" class="form-control">
    </div>
    <div class="form-group">
        <label>Village/Cell/Zone</label>
        <input type="text" name="village_owner" class="form-control">
    </div>
    <div class="form-group">
        <label>Mobile Phone</label>
        <input type="text" name="mobile_phone" class="form-control">
    </div>
    <center><p><strong>DETAILS OF  ALTERNATIVE CONTACT PERSON</strong></p></center>
    <div class="form-group">
        <label>Relationship to Owner</label>
        <input type="text" name="alt_relationship" class="form-control">
    </div>
    <div class="form-group">
        <label>Alternative Surname</label>
        <input type="text" name="alt_surname" class="form-control">
    </div>
    <div class="form-group">
        <label>Alternative Firstname</label>
        <input type="text" name="alt_fname" class="form-control">
    </div>
    <div class="form-group">
        <label>Alternative Phone Number</label>
        <input type="text" name="alt_phone_number" class="form-control">
    </div>
    <center><p><strong>SECTION B: PROPERTY PARTICULARS</strong></p></center>
    <div class="form-group">
        <label>Division</label>
        <input type="text" name="division_property" class="form-control">
    </div>
    <div class="form-group">
        <label>Parish</label>
        <input type="text" name="parish_property" class="form-control">
    </div>
    <div class="form-group">
        <label>Village</label>
        <input type="text" name="village_property" class="form-control">
    </div>
    <div class="form-group">
        <label>Road Frontage/GRID</label>
        <input type="text" name="roadfrontage_property" class="form-control">
    </div>
    <div class="form-group">
        <label>House Number</label>
        <input type="text" name="house_property" class="form-control">
    </div>
    <div class="form-group">
        <label>GPS Coordinates</label>
        <input type="text" name="gps_property" class="form-control">
    </div>
    <div class="form-group">
        <label>Plot Number</label>
        <input type="text" name="plot_number_property" class="form-control">
    </div>
    <div class="form-group">
        <label>Road Name</label>
        <input type="text" name="road_property" class="form-control">
    </div>
    <div class="form-group">
        <label>Type of Access</label>
        <select name="access_property" class="form-control">
            <option>Main Road: </option>
            <option>Side Road: </option>
            <option>Restricted road: </option>
            <option>Footpath: access </option>
        </select>
    </div>
    <div class="form-group">
        <label>Neighbourhood Status</label>
        <select name="neighbourhood_property" class="form-control">
            <option>Middle Class:</option>
            <option>High Class:</option>
            <option>Slum:</option>
        </select>

    </div>
    <div class="form-group">
        <label>Neighbourhood Activities</label>
        <select name="neighbourhood_activities_property" class="form-control">
            <option>Residential</option>
            <option>Commercial</option>
            <option>Industrial</option>
            <option>Agricultural</option>
        </select>
    </div>
    <center><p><strong>SECTION C : PROPERTY TYPE</strong></p></center>
    <div class="form-group">
        <label>Property Type</label>
        <select name="property_type" class="form-control">
            <option>Residential rented</option>
            <option>Commercial</option>
            <option>Institutional</option>
            <option>Industrial</option>
            <option>Agricultural</option>
            <option>Special properties</option>
        </select>
    </div>
    <div class="form-group">
        <label>Sub Property Type</label>
        <select name="subproperty_type" class="form-control">
            <?php 
            if(!empty($property_types)):

                foreach($property_types as $property_type):                  
                          print "<option>".$property_type->property_title."</option>";
                endforeach;

            endif;
            ?>
        </select>
    </div>
    <center><p><strong>SECTION D: BUILDING DETAILS</strong></p></center>
    <div class="form-group">
        <label>Level Of Completion </label>
        <select name="levelof_completion" class="form-control">
            <option>Complete</option>
            <option>InComplete</option>
        </select>
    </div>
    <div class="form-group">
        <label>Type of Building</label>
        <select name="typeof_building" class="form-control">
            <option>Storied</option>
            <option>Not Storied</option>
        </select>
    </div>
    <div class="form-group">
        <label>Block Number</label>
        <input type="text" name="block_number" class="form-control">
    </div>
    <div class="form-group">
        <label>Flat Number</label>
        <input type="text" name="flat_number" class="form-control">
    </div>
    <div class="form-group">
        <label>Building Condition</label>
        <select name="building_condition" class="form-control">
            <option>Excellent</option>
            <option>Good</option>
            <option>Fair</option>
            <option>Dilapidated</option>
            <option>Stalled/ abandoned</option>
        </select>
    </div>
<p><strong>SECTION E: CONSTRUCTION DETAILS</strong></p>
<div class="form-group">
    <label>Wall</label>
    <select name="wall" class="form-control">
        <option>Concrete frame</option>
        <option>Mud and wattle</option>
        <option>Iron sheets</option>
        <option>Glazed cladding</option>
        <option>Bricks</option>
        <option>Timber</option>
        <option>Metallic sheeting</option>
        <option>Stones</option>
        <option>Any other (provided space)</option>
    </select>
</div>
<div class="form-group">
    <label>Wall Finish</label>
    <select name="wall_finish" class="form-control">
        <option>Plastered</option>
        <option>Un plastered</option>
        <option>Tiled </option>
        <option>Clay bricks/ blocks</option>
        <option>Rough cast</option>
        <option>Rendered </option>
        <option>Random rubble</option>
        <option>Any other (provided space)</option>
    </select>
    </div>
    <div class="form-group">
        <label>Floor</label>
        <select name="floor" class="form-control">
                <option>Concrete</option>
                <option>Hardcore</option>
                <option>Timber</option>
                <option>Earth</option>
                <option>Stones</option>
                <option>Bricks</option>
                <option>Metallic</option>
                <option>Any other (provided space)</option>
        </select>
    </div>
    <div class="form-group">
        <label>Floor Construction</label>
        <select name="floor_construction" class="form-control">
            <option>Cement screed</option>
            <option>Terrazzo</option>
            <option>Wood Blocks</option>
            <option>Ceramic tiles</option>
            <option>Clay tiles</option>
            <option>Wood Parquets</option>
            <option>PVC Tiles</option>
            <option>Wood Strips</option>
            <option>Bricks</option>
            <option>Any other (provided space)</option>
        </select>
    </div>
    <div class="form-group">
        <label>Roof Covering</label>
        <select name="roof_covering" class="form-control">
            <option>Concrete Slab</option>
            <option>Slates</option>
            <option>Plain Sheet</option>
            <option>Tiles</option>
            <option>GCIS</option>
            <option>Asbestos</option>
            <option>Versatile</option>
            <option>IT4 Sheets</option>
            <option>Roof Shingles</option>
            <option>Papyrus</option>
            <option>Translucent sheets</option>
            <option>Open to Sky</option>
        </select>
    </div>
    <div class="form-group">
        <label>Ceiling</label>
        <select name="ceiling" class="form-control">
            <option>Plastered</option>
            <option>Gypsum</option>
            <option>Acoustic</option>
            <option>Soft Board</option>
            <option>plastered painted</option>
            <option>Plywood</option>
            <option>Timber Strips</option>
            <option>None</option>
        </select>
    </div>
    <div class="form-group">
        <label>Doors</label>
        <select name="doors" class="form-control">
            <option>Steel</option>
            <option>Timber</option>
            <option>Louvered</option>
            <option>Sliding</option>
            <option>Steel glazed</option>
            <option>Metal sheet</option>
            <option>Aluminum,</option>
            <option>GCIS</option>
        </select>
    </div>
    <div class="form-group">
        <label>Windows</label>
        <select name="windows" class="form-control">
            <option>Side Hung</option>
            <option>Steel</option>
            <option>Timber</option>
            <option>Louvered</option>
            <option>Sliding</option>
            <option>Steel glazed</option>
            <option>Metal sheet</option>
            <option>Aluminum,</option>
            <option>GCIS</option>
        </select>
    </div>
    <center><p><strong>BUILDING SPECIFICS</strong></p></center>
    <div class="form-group">
        <label>Photos*</label>
        <input type="file" name="photos[]" multiple="multiple">
    </div>
    <div class="form-group">
        <label>Enter Number of Levels</label>
        <input type="number" name="leves" class="form-control">
    </div>
    <div class="form-group">
        <label>Level Gross External Area</label>
        <input type="number" name="gross_external_area" class="form-control">
    </div>
    <div class="form-group">
        <label>Total Built up area M2</label>
        <input type="file" name="autocad_file" class="form-control" >
    </div>

    <center><p><strong>SECTION F: ACCOMMODATION</strong></p></center>
    <div class="form-group">
        <label>ACCOMODATION BREAKDOWN </label>
        <select name="accomodation_breakdown" class="form-control">
            <?php 
            if(!empty($accomodation_breakdowns)):
                foreach($accomodation_breakdowns as $accomodation_breakdown):

                    print "<option>".$accomodation_breakdown->accomodation_breakdown."</option>";
                endforeach;
            endif;
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Number of units</label>
        <input type="number" name="numberof_units" class="form-control">
    </div>
    <div class="form-group">
        <label>Rent</label>
        <input type="number" name="rent_amount" class="form-control">
    </div>
    <center><p><strong>SECTION G: ADDED FACILITIES & SERVICES</strong></p></center>
    <div class="form-group">
        <label>Water accessibility</label>
        <select name="water_accessibility" class="form-control">
            <option>Yes</option>
            <option>No</option>
        </select>
    </div>
    <div class="form-group">
        <label>Power Supply</label>
        <select name="power_supply" class="form-control">
            <option>Yes</option>
            <option>No</option>
        </select>
    </div>
    <div class="form-group">
        <label>Sanitation Type</label>
        <select name="sanitation_type" class="form-control">
            <option>Toilet</option>
            <option>Latrine</option>
            <option>Septic Tank</option>
            <option>Public Sewer</option>
            <option>None</option>
        </select>
    </div>
    <div class="form-group">
        <label>Parking Space available</label>
        <select name="parking_space" class="form-control">
            <option>Yes</option>
            <option>No</option>
        </select>
    </div>
    <div class="form-group">
        <label>Other Services</label>
        <input type="text" name="other_services" class="form-control">
    </div>
    <div class="form-group">
        <label>Boundary Fence</label>
        <select name="boundary_fence" class="form-control">
            <option>Wall Fence</option>
            <option>Barbed wire</option>
            <option>Chain Link</option>
            <option>Metal Grilles</option>
            <option>Retainer wall</option>
            <option>Hedge</option>
            <option>Other</option>
            <option>None</option>
        </select>
    </div>
    <div class="form-group">
        <label>Gate</label>
        <select name="gate" class="form-control">
            <option>Metal Sheet</option>
            <option>Metal Grilles,</option>
            <option>GCIS</option>
            <option>Sliding Metallic</option>
            <option>High density Fiber boards</option>
            <option>Automatic entrance/exit blocking</option>
            <option>None</option>
        </select>
    </div>
    <div class="form-group">
        <label>Compound</label>
        <select name="compound" class="form-control">
            <option>Tarmac</option>
            <option>Paved</option>
            <option>Lawn</option>
            <option>Stone </option>
            <option>Concrete</option>
            <option>Terrazz </option>
            <option>Earth </option>
            <option>Tiles </option>
            <option>Random Rubble </option>
            <option>Bricks </option>
            <option>None</option>
        </select>
    </div>
    <div class="form-group">
        <label>Comments</label>
        <textarea name="comments" class="form-control" placeholder="Type Comments about property Here"></textarea>
    </div>
    <div class="form-group">
        <label>&nbsp;</label>
        <center><button class="btn btn-success btn-lg" type="submit">Finish</button></center>
    </div>
                          </form>
